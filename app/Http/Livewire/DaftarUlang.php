<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Exports\ExportArray;
use Excel;

class DaftarUlang extends Component
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
    public $listjurusan = [];
    public $filjurusan;
    public $waktu_bayar;
    public $waktu_awal, $waktu_akhir;

    protected $listeners = ['hapusDu' => 'hapusDu'];

    public function mount(){
        $this->waktu_awal = \Carbon\Carbon::now()->format('Y-m-d');
        $this->waktu_akhir = \Carbon\Carbon::now()->format('Y-m-d');
    }
    public function render()
    {
        $this->listjurusan = DB::table('m_jurusan')->get();
        return view('livewire.daftar-ulang', [
            'data' => $this->getPaginate(),
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
        ->join('m_jurusan as j', 'j.id', '=', 'i.jurusan_id_lulus')
        ->join('d_daftar_ulang as du','du.pendaftaran_id','=', 'i.id')
        ->leftJoin('d_bayar_spp as bs', 'bs.pendaftaran_id', 'i.id')
        ->leftJoin('m_kecamatan as mk', 'mk.id', '=', 'i.kecamatan_id')
        ->leftJoin('m_kelurahan as ml', 'ml.id', '=', 'i.kelurahan_id')
        ->leftJoin('m_jenis_tinggal as jt', 'jt.id', '=', 'i.jenis_tinggal_id')
        ->leftJoin('m_agama as ma', 'ma.id', '=', 'i.agama_id')

        ->select('i.*', 'j.nama as jurusan', 'j.kode_prodi', 'du.waktu as waktu_daftar_ulang',
        'mk.nama as kecamatan', 'ml.nama as kelurahan', 'jt.keterangan as jenis_tinggal',
        'ma.nama as agama', 
        DB::raw('(bs.spp+bs.pendidikan+bs.almamater+bs.lain) as biaya')
    );

        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('i.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('i.no_daftar', 'like', '%'.$cari.'%');
                $q->orWhere('i.nim', 'like', '%'.$cari.'%');
            });
        }
        if($this->filjurusan>0){
            $data = $data->where('i.jurusan_id_lulus', '=', $this->filjurusan);
        }
        
        return $data;
    }
    private function getPaginate(){
        $data = $this->getData();
        return $data->paginate($this->perpage);
    }
    public function confirmHapus($id){
        $this->idp = $id;
        $data = DB::table('d_pendaftaran')->where('id', '=', $id)->first();
        $this->emit('confirmHapus', $data ? $data->nama_depan.' '.$data->nama_belakang : '');
    }
    public function hapusDu(){
        DB::table('d_pendaftaran')->where('id', '=', $this->idp)->update([
            'status_daftar_ulang' => null,
            'nim' => null
        ]);
        DB::table('d_daftar_ulang')->where('pendaftaran_id', '=', $this->idp)->delete();
        $this->idp = null;

        return session()->flash('message', 'Sukses hapus data Daftar Ulang');
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
        $coltitle = ['NO', 'NIM', 'NAMA', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 'JENIS KELAMIN', 'NIK', 'AGAMA', 'NISN', 'KEWARGANEGARAAN', 
        'JALAN', 'RT', 'RW', 'NAMA DUSUN', 'KELURAHAN', 'KECAMATAN', 'KODE POS', 'JENIS TINGGAL', 'NO HP', 'EMAIL',
        'NIK AYAH', 'NAMA AYAH', 'TGL LAHIR AYAH', 'PEKERJAAN AYAH', 'NIK IBU', 'NAMA IBU',
        'KODE PRODI', 'JUMLAH BIAYA MASUK'
        ];
        // $coltitle = ['NO', 'NO DAFTAR', 'NIM', 'NAMA LENGKAP', 'JURUSAN', 'TANGGAL', 'PEMBAYARAN SPP'];
        $data = $this->getData()->get();
        if($data){
            $rowdata = [];
            foreach ($data as $key => $val) {
                $row = [
                    $key+1, 
                    $val->nim.' ', 
                    $val->nama_depan.' '.$val->nama_belakang,
                    $val->tempat_lahir,
                    $val->tanggal_lahir,
                    $val->jenis_kelamin,
                    $val->nik.' ',
                    $val->agama,
                    $val->nisn,
                    $val->warganegara,
                    $val->alamat,
                    $val->rt,
                    $val->rw,
                    $val->dusun,
                    $val->kelurahan,
                    $val->kecamatan,
                    $val->kodepos,
                    $val->jenis_tinggal,
                    $val->hp,
                    $val->email,
                    $val->nik_ayah.' ', $val->nama_ayah, $val->tgl_lahir_ayah, $val->pekerjaan_ayah, $val->nik_ibu.' ', $val->nama_ibu,
                    $val->kode_prodi, 
                    $val->biaya,
                ];
                array_push($rowdata, $row);
            }

            $export = new ExportArray([
                $coltitle,
                $rowdata
            ]);
            $filename = $this->namafile ? $this->namafile.'.xlsx' : 'export_daftar_ulang.xlsx';
            $this->inputnamafile = null;
            return Excel::download($export, $filename);
        }
    }
}
