<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SeleksiJadwal extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query;
    public $listjurusan;
    public $jurusan_id;
    public $perpage = 5;
    public $idp = 0;
    public $idj;
    public $tanggal_jam;

    public $tanggal, $jam, $ruangan;

    public $filter_tanggal = [];
    public $filter_ruangan = [];
    public $f_tanggal, $f_ruangan;

    protected $rules = [
        'tanggal' => 'required|date',
        'jam' => 'required',
        'ruangan' => 'required',
    ];
    protected $messages = [
            'tanggal.required' => 'TANGGAL tidak boleh kosong',
            'jam.required' => 'JAM tidak boleh kosong',
            'ruangan.required' => 'RUANGAN tidak boleh kosong',
    ];

    public function render()
    {
        $this->listjurusan = DB::table('m_jurusan')->get();
        $this->setFilter();

        $data = $this->getData();

        return view('livewire.seleksi-jadwal', [
            'data' => $data,
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function setFilter(){        
        $tgl = DB::table('d_seleksi_jadwal')
            ->select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'asc')->get();
        foreach ($tgl as $key => $value) {
            $value->tanggal_label = \Carbon\Carbon::parse($value->tanggal)->format('d M Y');
        }
        $this->filter_tanggal = $tgl;
        $this->filter_ruangan = DB::table('d_seleksi_jadwal')
            ->select('ruangan')->groupBy('ruangan')->orderBy('ruangan', 'asc')->pluck('ruangan');
    }
    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
        ->join('m_jurusan as j', 'j.id', '=', 'i.jurusan_id')
        ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')

        ->leftJoin('d_seleksi_jadwal as sj','sj.pendaftaran_id','=', 'i.id')
        ->select('i.*', 'j.nama as jurusan',  'sj.tanggal', 'sj.jam', 'sj.ruangan',
        DB::raw('if(i.id='.$this->idp.', 1, 0) as onedit'),
        DB::raw('concat(sj.tanggal," ", sj.jam) as tanggal_jam')
    );

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
                $data = $data->where('sj.tanggal', '=', null);
            }else{
                $data = $data->whereDate('sj.tanggal', '=', $this->f_tanggal);
            }
            
        }
        if($this->f_ruangan!=''){
            if($this->f_ruangan=='Kosong'){
                $data = $data->where('sj.ruangan', '=', null);
            }else{
                $data = $data->where('sj.ruangan', '=', $this->f_ruangan);
            }
        }
        
        $data = $data->orderBy('i.no_daftar', 'asc');
        $data = $data->paginate($this->perpage);
        return $data;
    }
    public function save($idp){
        $this->tanggal = \Carbon\Carbon::parse($this->tanggal_jam)->format('Y-m-d');
        $this->jam = \Carbon\Carbon::parse($this->tanggal_jam)->format('H:i');
        $this->validate();
        $daftar = DB::table('d_pendaftaran')->where('id', '=', $idp)->first();
        
        $d_jadwal = DB::table('d_seleksi_jadwal')->where('pendaftaran_id', '=', $idp)->first();
        $this->idj = $d_jadwal ? $d_jadwal->id : null;
        $data = [
            'pendaftaran_id' => $idp,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'ruangan' => $this->ruangan,
            'user_id' => auth()->user()->id,
            'waktu' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'jurusan_id' => $daftar->jurusan_id,
        ];

        if($d_jadwal){
            DB::table('d_seleksi_jadwal')->where('id', '=', $d_jadwal->id)->update($data);
        }else{
            $this->idj = DB::table('d_seleksi_jadwal')->insertGetId($data);
        }
        DB::table('d_pendaftaran')->where('id', '=', $idp)->update([
            'status_jadwal' => $this->idj,
        ]);
        $this->idp = 0;
    }
    public function batal(){
        $this->idp = 0;
    }
    public function edit($idp){
        $this->idp = $idp;
        $d_jadwal = DB::table('d_seleksi_jadwal')->where('pendaftaran_id', '=', $idp)->first();

        if($d_jadwal){
            $this->tanggal_jam = \Carbon\Carbon::parse($d_jadwal->tanggal)->format('Y-m-d').' '.$d_jadwal->jam;
            $this->ruangan = $d_jadwal->ruangan;
           
        }
    }
}
