<?php

namespace App\Http\Livewire;

use App\Exports\ExportPembayaran;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Excel;

class BayarPendaftaran extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $query;
    public $perpage = 5;
    public $no_daftar;
    public $idp, $nama_depan, $nama_belakang, $jenis_kelamin, $jurusan_id, $jurusan, $waktu;
    public $idb;
    public $jumlah;
    public $sudah_bayar = false;
    public $listjurusan;
    public $filjurusan;

    public $waktu_bayar;
    

    protected $listeners = ['hapusBayar' => 'hapusBayar'];
    public function mount(){
        $this->waktu_bayar = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
    }
    public function render()
    {
        $set = DB::table('d_setting')->first();
        $this->jumlah = $set->biaya_pendaftaran;
        $this->listjurusan = DB::table('m_jurusan')->get();
        return view('livewire.bayar-pendaftaran', [
            'data' => $this->getPaginate(),
        ])
        ->extends('layouts.app')
        ->section('content');
    }

    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
        ->join('m_jurusan as j', 'j.id', '=', 'i.jurusan_id')
        
        ->join('d_bayar_pendaftaran as bp','bp.pendaftaran_id','=', 'i.id')
        ->select('i.*', 'j.nama as jurusan', 'bp.jumlah', 'bp.waktu as waktu_bayar', 'bp.id as idb');
        

        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('i.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('i.no_daftar', 'like', '%'.$cari.'%');
            });
        }
        if($this->filjurusan>0){
            $data = $data->where('i.jurusan_id', '=', $this->filjurusan);
        }
        
        return $data;
    }
    private function getPaginate(){
        $data = $this->getData();
        return $data->paginate($this->perpage);
    }
    public function tambah(){
        $this->idp = null;

        if($this->no_daftar=='') return;

        $this->no_daftar = trim($this->no_daftar);

        if(!$this->cekSudahBayar($this->no_daftar)){
            $data = DB::table('d_pendaftaran as p')
            ->join('m_jurusan as j', 'j.id', '=', 'p.jurusan_id')
            ->select('p.*', 'j.nama as jurusan')
            ->where('p.no_daftar', '=', $this->no_daftar)
            ->first();
            if($data){
                $this->idp = $data->id;
                $this->nama_depan = $data->nama_depan;
                $this->nama_belakang = $data->nama_belakang;
                $this->jenis_kelamin = $data->jenis_kelamin;
                $this->jurusan_id = $data->jurusan_id;
                $this->jurusan = $data->jurusan;
                $this->waktu = $data->waktu;
            
            }else{
                $this->idp = null;
            }
        }else{
            $this->idp = null;
        }
        
    }
    private function cekSudahBayar($no_daftar){
        $data = DB::table('d_pendaftaran as p')
        ->join('m_jurusan as j', 'j.id', '=', 'p.jurusan_id')
        ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'p.id')
        ->select('p.*', 'j.nama as jurusan')
        ->where('p.no_daftar', '=', $no_daftar)
        ->first();
        if($data){
            $this->sudah_bayar = true;
            $this->nama_depan = $data->nama_depan;
            $this->nama_belakang = $data->nama_belakang;
            $this->jurusan = $data->jurusan;
            return true;
        }else {
            $this->sudah_bayar = false;
            return false;
        }
    }
    public function save(){
        if($this->idp){
            $this->idb = DB::table('d_bayar_pendaftaran')->insertGetId([
                'pendaftaran_id' => $this->idp,
                'jumlah' => $this->jumlah,
                'user_id' => auth()->user()->id,
                'waktu' => $this->waktu_bayar, //\Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('d_pendaftaran')->where('no_daftar', '=', $this->no_daftar)->update(['status_bayar'=>$this->idb]);
            session()->flash('message', 'Sukses Input Data Pembayaran');
            $this->clear();
        }
    }
    public function confirmHapus($idb){
        $this->idb  = $idb;
        $data = DB::table('d_bayar_pendaftaran as bp')
        ->join('d_pendaftaran as p', 'p.id', '=', 'bp.pendaftaran_id')
        ->join('m_jurusan as j', 'j.id', '=', 'p.jurusan_id')
        ->select('p.nama_depan', 'p.nama_belakang', 'j.nama as jurusan', 'p.id', 'p.no_daftar')
        ->where('bp.id', '=', $idb)
        ->first();
        $mesage = 'Yakin akan menghapus data ini?';
        if($data){
            $this->no_daftar = $data->no_daftar;
            $this->idp = $data->id;
            $this->nama_depan = $data->nama_depan;
            $this->nama_belakang = $data->nama_belakang;
            $this->jurusan = $data->jurusan;
            $mesage = 'Data pembayaran pendaftaran dari: '.$this->nama_depan.' '.$this->nama_belakang.', Jurusan: '.$this->jurusan.', Yakin akan dihapus?';
        }
        
        $this->emit('confirmHapus', $mesage);
    }
    public function hapusBayar(){
        DB::table('d_bayar_pendaftaran')->where('id', '=', $this->idb)->delete();
        DB::table('d_pendaftaran')->where('id', '=', $this->idp)->update(['status_bayar'=>null]);
        session()->flash('message', 'Sukses hapus Data Pembayaran');
        $this->clear();
    }
    private function clear(){
        $this->idp = null;
        $this->idb = null;
        $this->nama_depan = null;
        $this->nama_belakang = null;
        $this->jurusan = null;
        $this->sudah_bayar = false;
    }
    
    public $namafile;
    public $inputnamafile;
    public function toexport(){
        $this->inputnamafile = true;
    }
    public function batalexport(){
        $this->inputnamafile = null;
    }
    public function export(){
        $coltitle = ['NO', 'NO DAFTAR', 'NAMA LENGKAP', 'JURUSAN', 'JUMLAH', 'TANGGAL'];
        $data = $this->getData()->get();
        if($data){
            $rowdata = [];
            foreach ($data as $key => $val) {
                $row = [
                    $key+1, 
                    $val->no_daftar, 
                    $val->nama_depan.' '.$val->nama_belakang,
                    $val->jurusan,
                    $val->jumlah,
                    \Carbon\Carbon::parse($val->waktu)->format('d/m/Y'),
                ];
                array_push($rowdata, $row);
            }

            $export = new ExportPembayaran([
                $coltitle,
                $rowdata
            ]);
            $filename = $this->namafile ? $this->namafile.'.xlsx' : 'export_pembayaran_pendaftaran.xlsx';
            $this->inputnamafile = null;
            return Excel::download($export, $filename);
        }
    }
}
