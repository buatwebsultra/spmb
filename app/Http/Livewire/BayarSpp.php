<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Exports\ExportPembayaran;
use Excel;

class BayarSpp extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query;
    public $perpage = 5;
    public $no_daftar;
    public $nim;
    public $idp, $nama_depan, $nama_belakang, $jenis_kelamin, $jurusan_id, $jurusan, $waktu;
    public $idb;
    public $jumlah;
    public $sudah_bayar = false;
    public $listjurusan;
    public $filjurusan;
    public $waktu_bayar;

    protected $listeners = ['hapusBayar' => 'hapusBayar'];
    public $namafile;
    public $inputnamafile=null;

    public $spp, $pendidikan, $almamater, $lain;

    public function mount(){
        $this->waktu_bayar = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $set = DB::table('d_setting')->first();
        $this->spp = $set->biaya_spp;
        $this->pendidikan = $set->biaya_pendidikan;
        $this->almamater = $set->biaya_almamater;
        $this->lain = $set->biaya_lain;
    }

    public function render()
    {
        $set = DB::table('d_setting')->first();
        $this->jumlah = $this->spp + $this->pendidikan + $this->almamater + $this->lain;
        $this->listjurusan = DB::table('m_jurusan')->get();
        return view('livewire.bayar-spp', [
            'data' => $this->getPaginate(),
            'setting' => $set,
        ])
        ->extends('layouts.app')
        ->section('content');
    }

    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
        
        ->join('d_daftar_ulang as du', 'du.pendaftaran_id', '=', 'i.id')
        ->join('m_jurusan as j', 'j.id', '=', 'du.jurusan_id')
        ->join('d_bayar_spp as bp','bp.pendaftaran_id','=', 'i.id')
        ->select('i.*', 'j.nama as jurusan', 
        'bp.jumlah', 'bp.spp', 'bp.pendidikan', 'bp.almamater', 'bp.lain', 'du.waktu as waktu_daftar_ulang',  'bp.waktu as waktu_bayar', 'bp.id as idb');

        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('i.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('i.no_daftar', 'like', '%'.$cari.'%');
                $q->orWhere('i.nim', 'like', '%'.$cari.'%');
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
        if($this->nim=='') return;
        $this->nim = trim($this->nim);

        $data_du = DB::table('d_daftar_ulang')->where('nim', '=', $this->nim)->first();
        if(!$data_du) {
            $this->clear();
            return;
        };
        $this->idp = $data_du->pendaftaran_id;


        if(!$this->cekSudahBayar($this->idp)){
            $data = DB::table('d_pendaftaran as p')
            ->join('d_daftar_ulang as du', 'du.pendaftaran_id', '=', 'p.id')
            ->join('m_jurusan as j', 'j.id', '=', 'du.jurusan_id')
            ->select('p.*', 'j.nama as jurusan', 'du.waktu as waktu_daftar_ulang')
            ->where('p.id', '=', $this->idp)
            ->first();

            if($data){
                $this->no_daftar = $data->no_daftar;
                $this->idp = $data->id;
                $this->nama_depan = $data->nama_depan;
                $this->nama_belakang = $data->nama_belakang;
                $this->jenis_kelamin = $data->jenis_kelamin;
                $this->jurusan_id = $data->jurusan_id_lulus;
                $this->jurusan = $data->jurusan;
                $this->waktu = $data->waktu_daftar_ulang;
            }else{
                $this->idp = null;
            }
        }else{
            $this->idp = null;
        }
        
    }
    private function cekSudahBayar($idp){
        $data = DB::table('d_pendaftaran as p')
        ->join('m_jurusan as j', 'j.id', '=', 'p.jurusan_id_lulus')
        ->join('d_bayar_spp as bp', 'bp.pendaftaran_id', '=', 'p.id')
        ->select('p.*', 'j.nama as jurusan')
        ->where('p.id', '=', $idp)
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
            $this->idb = DB::table('d_bayar_spp')->insertGetId([
                'pendaftaran_id' => $this->idp,
                'jumlah' => $this->jumlah,
                'spp' => $this->spp,
                'pendidikan' => $this->pendidikan,
                'almamater' => $this->almamater,
                'lain' => $this->lain,

                'user_id' => auth()->user()->id,
                'waktu' => $this->waktu_bayar, //\Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('d_pendaftaran')->where('no_daftar', '=', $this->no_daftar)->update(['status_spp'=>$this->idb]);
            session()->flash('message', 'Sukses Input Data Pembayaran SPP 1');
            $this->clear();
        }
    }
    public function confirmHapus($idb){
        $this->idb  = $idb;
        $data = DB::table('d_bayar_spp as bp')
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
            $mesage = 'Data pembayaran SPP dari: '.$this->nama_depan.' '.$this->nama_belakang.', Jurusan: '.$this->jurusan.', Yakin akan dihapus?';
        }
        
        $this->emit('confirmHapus', $mesage);
    }
    public function hapusBayar(){
        $data = DB::table('d_bayar_spp')->where('id', '=', $this->idb)->first();
        DB::table('d_bayar_spp')->where('id', '=', $this->idb)->delete();
        DB::table('d_pendaftaran')->where('id', '=', ($data ? $data->pendaftaran_id : '0'))->update(['status_spp'=>null]);
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

    

    public function toexport(){
        $this->inputnamafile = true;
    }
    public function batalexport(){
        $this->inputnamafile = null;
    }
    public function export(){
        
        $coltitle = ['NO', 'NO DAFTAR', 'NIM', 'NAMA LENGKAP', 'JURUSAN',  'SPP', 'PENDIDIKAN','ALMAMATER','LAIN', 'JUMLAH', 'TANGGAL'];
        $data = $this->getData()->get();
        if($data){
            $rowdata = [];
            foreach ($data as $key => $val) {
                $row = [
                    $key+1, 
                    $val->no_daftar, 
                    $val->nim.' ', 
                    $val->nama_depan.' '.$val->nama_belakang,
                    $val->jurusan,
                    $val->spp,
                    $val->pendidikan,
                    $val->almamater,
                    $val->lain,
                    $val->jumlah,
                    \Carbon\Carbon::parse($val->waktu)->format('d/m/Y'),
                ];
                array_push($rowdata, $row);
            }

            $export = new ExportPembayaran([
                $coltitle,
                $rowdata
            ]);
            $filename = $this->namafile ? $this->namafile.'.xlsx' : 'export_biaya_masuk.xlsx';
            $this->inputnamafile = null;
            return Excel::download($export, $filename);
        }
        
    }
}
