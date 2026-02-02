<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SeleksiHasil extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query;
    public $listjurusan;
    public $jurusan_id;
    public $perpage = 5;
    public $idp = 0;
    public $idj;

    public $tanggal_pengumuman, $nilai, $status;

    public $filter_tanggal = [];
    public $filter_status = [];
    public $f_tanggal, $f_status;

    public $filter_ruangan = [];
    public $f_ruangan;

    public $jurusan_id_pilih;
    public $jurusan_pilihan = [];
    protected $listeners = ['hapusHasil' => 'hapusHasil'];
    // public $onhapus = false;

    protected $rules = [
        'tanggal_pengumuman' => 'required|date',
        'nilai' => 'required',
        'status' => 'required',
        'jurusan_id_pilih' => 'required',
    ];
    protected $messages = [
            'tanggal_pengumuman.required' => 'TANGGAL tidak boleh kosong',
            'nilai.required' => 'NILAI tidak boleh kosong',
            'status.required' => 'STATUS tidak boleh kosong',
            'jurusan_id_pilih.required' => 'JURUSAN tidak boleh kosong',
    ];

    public function render()
    {
        $this->jurusan_pilihan = $this->pilJurusan($this->idp);
        $jurusan = DB::table('m_jurusan');
        if (auth()->user()->jurusan_id > 0) {
            $jurusan = $jurusan->where('id', auth()->user()->jurusan_id);
        }
        $this->listjurusan = $jurusan->get();
        $this->setFilter();

        $data = $this->getData();

        return view('livewire.seleksi-hasil', [
            'data' => $data,
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function setFilter(){        
        $tgl = DB::table('d_seleksi_hasil')
            ->select('tanggal_pengumuman')->groupBy('tanggal_pengumuman')->orderBy('tanggal_pengumuman', 'asc')->get();
        foreach ($tgl as $key => $value) {
            $value->tanggal_label = \Carbon\Carbon::parse($value->tanggal_pengumuman)->format('d M Y');
        }
        $this->filter_tanggal = $tgl;
        $this->filter_status = DB::table('m_status')->get();
        $this->filter_ruangan = DB::table('d_seleksi_jadwal')
            ->select('ruangan')->groupBy('ruangan')->orderBy('ruangan', 'asc')->pluck('ruangan');
    }
    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
        ->join('m_jurusan as j', 'j.id', '=', 'i.jurusan_id')
        ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
        ->leftJoin('d_seleksi_jadwal as sw','sw.pendaftaran_id','=', 'i.id')
        
        ->leftJoin('d_seleksi_hasil as sj','sj.pendaftaran_id','=', 'i.id')
        ->leftJoin('m_jurusan as mj', 'mj.id', '=', 'sj.jurusan_id')
        ->leftJoin('m_status as ms', 'ms.id', '=', 'sj.status')
        ->select('i.*', 'j.nama as jurusan',  'sj.tanggal_pengumuman', 'sj.status', 'sj.nilai', 'ms.nama as status_label', 'sw.ruangan', 'mj.nama as jurusan_pilihan',
        DB::raw('if(i.id='.$this->idp.', 1, 0) as onedit')
        );

        if (auth()->user()->jurusan_id > 0) {
            $data = $data->where('i.jurusan_id', '=', auth()->user()->jurusan_id);
        }

        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('i.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('i.nama_belakang', 'like', '%'.$cari.'%');
                $q->orWhere('i.no_daftar', 'like', '%'.$cari.'%');
            });
        }
        if($this->jurusan_id>0){
            $data = $data->where('i.jurusan_id', '=', $this->jurusan_id);
        }
        if($this->f_tanggal!=''){
            if($this->f_tanggal=='Kosong'){
                $data = $data->where('sj.tanggal_pengumuman', '=', null);
            }else{
                $data = $data->whereDate('sj.tanggal_pengumuman', '=', $this->f_tanggal);
            }
            
        }
        if($this->f_status!=''){
            if($this->f_status=='Kosong'){
                $data = $data->where('sj.status', '=', null);
            }else{
                $data = $data->where('sj.status', '=', $this->f_status);
            }
        }
        if($this->f_ruangan!=''){
            if($this->f_ruangan=='Kosong'){
                $data = $data->where('sw.ruangan', '=', null);
            }else{
                $data = $data->where('sw.ruangan', '=', $this->f_ruangan);
            } 
        }
        $data = $data->orderBy('i.no_daftar', 'asc');

        $data = $data->paginate($this->perpage);
        return $data;
    }
    public function save($idp){
        $this->validate();

        $d_jadwal = DB::table('d_seleksi_hasil')->where('pendaftaran_id', '=', $idp)->first();
        $this->idj = $d_jadwal ? $d_jadwal->id : null;
        $data = [
            'pendaftaran_id' => $idp,
            'jurusan_id' => $this->jurusan_id_pilih,
            'nomor_pil' => $this->getNoPilJur($idp, $this->jurusan_id_pilih),
            'tanggal_pengumuman' => $this->tanggal_pengumuman,
            'status' => $this->status,
            'nilai' => $this->nilai,
            'user_id' => auth()->user()->id,
            'waktu' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ];

        if($d_jadwal){
            DB::table('d_seleksi_hasil')->where('id', '=', $d_jadwal->id)->update($data);
        }else{
            $this->idj = DB::table('d_seleksi_hasil')->insertGetId($data);
        }
        $last = DB::table('d_pendaftaran')->where('id', '=', $idp)->first();
        DB::table('d_pendaftaran')->where('id', '=', $idp)->update([
            'status_lulus'=>$this->idj,
            'waktu_update' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'jurusan_id_lulus' => $this->jurusan_id_pilih,

        ]);
        $this->idp = 0;
    }
    private function getNoPilJur($idp, $id){
        $nopil = 1;
        $jurusan_pilihan = $this->pilJurusan($idp);
        foreach ($jurusan_pilihan as $key => $value) {
            if($value->id==$id){
                $nopil = $key+1;
            }
        }
        return $nopil;
    }
    public function batal(){
        $this->idp = 0;
    }
    public function edit($idp){
        $this->idp = $idp;
        $this->jurusan_pilihan = $this->pilJurusan($idp);
        $d_seleksi = DB::table('d_seleksi_hasil')->where('pendaftaran_id', '=', $idp)->first();
        if($d_seleksi){
            $this->tanggal_pengumuman = $d_seleksi->tanggal_pengumuman;
            $this->status = $d_seleksi->status;
            $this->nilai = $d_seleksi->nilai;
            $this->jurusan_id_pilih = $d_seleksi->jurusan_id ? $d_seleksi->jurusan_id : $this->jurusan_pilihan[0]->id;
            
        }else{
            $this->jurusan_id_pilih = $this->jurusan_pilihan[0]->id;
        }
    }
    private function pilJurusan($idp){
        $piljur = DB::table('d_pendaftaran')->select('jurusan_id', 'jurusan_id2', 'jurusan_id3')->where('id', '=', $idp)->first();
        $piljur_arr = $piljur ? [$piljur->jurusan_id, $piljur->jurusan_id2, $piljur->jurusan_id3] : [];
        $jurusan_pilihan = $this->getPilihanJurusan($piljur_arr); 
        return $jurusan_pilihan;
    }
    public function hapusHasil($idp){
        $daftar = DB::table('d_pendaftaran')->where('id', '=', $idp)->first();
        DB::table('d_seleksi_hasil')->where('pendaftaran_id', '=', $idp)->delete();
        DB::table('d_pendaftaran')->where('id', '=', $idp)
            ->update(['status_lulus'=> null,  
            'waktu_update' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'), 
            'jurusan_id_lulus' => null,
        
        ]);
    }
    public function confirmHapus($idp){
        // $this->onhapus = true;
        // $this->idp = $idp;
        $this->emit('confirmHapus', $idp);
    }
    private function getPilihanJurusan($piljurarr){
        $pil = [];
        foreach ($piljurarr as $key => $value) {
            $jur = DB::table('m_jurusan')->where('id', '=', $value)->first();
            if($jur){
                array_push($pil, $jur);
            }
        }
        return $pil;
    }
}
