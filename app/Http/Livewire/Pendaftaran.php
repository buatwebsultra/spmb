<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use File;
use App\Exports\ExportArray;
use Excel;

class Pendaftaran extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query = '';
    public $periode;
    public $waktu_awal, $waktu_akhir;
    public $provinsi_id, $kabkota_id;
    public $jurusan_id;
    public $perpage = 5;
    public $idd;
    public $provinsi, $kabkota, $jurusan;
    public $filter_upload;
    public $filter_jenis_daftar;

    protected $listeners = ['hapusMaba' => 'hapusPendaftaran'];
    public function mount(){
        $this->waktu_awal = \Carbon\Carbon::now()->format('Y-m-d');
        $this->waktu_akhir = \Carbon\Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $this->provinsi = DB::table('m_provinsi')->get();
        $this->kabkota = $this->provinsi_id>0 ? DB::table('m_kabkota')->where('provinsi_id', '=', $this->provinsi_id)->get() : [];
        $jurusan = DB::table('m_jurusan');
        if (auth()->user()->jurusan_id > 0) {
            $jurusan = $jurusan->where('id', auth()->user()->jurusan_id);
        }
        $this->jurusan = $jurusan->get();
        return view('livewire.pendaftaran', [
            'data' => $this->getPaginate(),
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
            ->leftJoin('users as u','u.id', '=', 'i.user_id')
            ->leftJoin('m_provinsi as mp', 'mp.id', '=', 'i.provinsi_id')
            ->leftJoin('m_kabkota as mb', 'mb.id', '=', 'i.kabkota_id')
            ->leftJoin('m_jurusan as p', 'p.id', '=', 'i.jurusan_id')
            ->select('i.*', 'u.name as user', 'mp.nama as provinsi', 'mb.nama as kabkota',
                    'p.nama as jurusan');
        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('i.nisn', 'like', '%'.$cari.'%');
                $q->orWhere('i.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('i.no_daftar', 'like', $cari.'%');
            });
        }
        if (auth()->user()->jurusan_id > 0) {
            $data = $data->where('i.jurusan_id', '=', auth()->user()->jurusan_id);
        }
        if($this->periode>0){
            $data = $data->whereDate('i.waktu', '>=', $this->waktu_awal)->whereDate('i.waktu', '<=', $this->waktu_akhir);
        }
        if($this->jurusan_id>0){
            $data = $data->where('i.jurusan_id', '=', $this->jurusan_id);
        }
        if($this->provinsi_id>0){
            $data = $data->where('i.provinsi_id', '=', $this->provinsi_id);
        }
        if($this->provinsi_id>0 && $this->kabkota_id>0){
            $data = $data->where('i.kabkota_id', '=', $this->kabkota_id);
        }
        if($this->filter_upload!=''){
            $fil = 'i.photo_image is not null and i.ijazah_image is not null';
            switch ($this->filter_upload) {
                case 'photo':
                    $fil = 'i.photo_image is not null';
                  break;
                case 'ijazah':
                    $fil = 'i.ijazah_image is not null';
                  break;
                case 'no_photo':
                    $fil = 'i.photo_image is null';
                  break;
                case 'no_ijazah':
                    $fil = 'i.ijazah_image is null';
                    break;
                case 'tidak_lengkap':
                    $fil = 'i.photo_image is  null or i.ijazah_image is  null';
                    break;
                case 'lengkap':
                    $fil = 'i.photo_image is not null and i.ijazah_image is not null';
                    break;
                default:
                    $fil = 'i.photo_image is not null and i.ijazah_image is not null';
            }
            
            $data = $data->whereRaw($fil);
        }
        if($this->filter_jenis_daftar!=''){
            $data = $data->where('i.jenis_daftar', '=', $this->filter_jenis_daftar);
        }
        $data = $data->orderBy('i.id', 'desc');
        
        return $data;
    }
    private function getPaginate(){
        $data = $this->getData();
        return $data->paginate($this->perpage);
    }
    public function confirmHapus($id){
        $this->idd = $id;
        $data = DB::table('d_pendaftaran')->where('id', '=', $id)->first();
        $this->emit('confirmHapus', $data ? $data->nama_depan.' '.$data->nama_belakang : '');
    }
    public function hapusPendaftaran(){
        $data = DB::table('d_pendaftaran')->where('id', '=', $this->idd)->first();

        $user_id = $data ? $data->user_id : 0;
        $no_daftar = $data ? $data->no_daftar : null;

        DB::table('d_pendaftaran')->where('id', '=', $this->idd)->delete();
        DB::table('users')->where('id', '=', $user_id)->update(['pendaftaran_id'=>null]);

        $this->hapusAllImage($no_daftar);

        session()->flash('message', 'Sukses hapus data Pendaftaran');
        $this->idd = null;
    }
    private function hapusAllImage($no_daftar){
        if($no_daftar){
            if (File::exists(storage_path('app/photo/'.$no_daftar))) {
                File::delete(storage_path('app/photo/'.$no_daftar));
            }
            if (File::exists(storage_path('app/ijazah/'.$no_daftar))) {
                File::delete(storage_path('app/ijazah/'.$no_daftar));
            }
            if (File::exists(storage_path('app/ortu_ttd/'.$no_daftar))) {
                File::delete(storage_path('app/ortu_ttd/'.$no_daftar));
            }
            if (File::exists(storage_path('app/ttd/'.$no_daftar))) {
                File::delete(storage_path('app/ttd/'.$no_daftar));
            }
        }
        
    }
    public function edit($id){
        session()->flash('id', $id);
        session()->put('pendaftaran_id', $id);
        return redirect()->route('pendaftaran.form', ['idp'=>$id]);
    }
    public function show($id){
        return redirect()->route('pendaftaran.show', ['idp'=>$id]);
    }
    public $show_image;
    public function showImage($url){
        $this->show_image = $url;
        $this->emit('showImage');
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
        $coltitle = ['NO', 'NO DAFTAR', 'NAMA LENGKAP', 'L/P', 'NISN', 'ASAL SEKOLAH', 'PIL. JURUSAN', 'TANGGAL', 'PROVINSI', 'KABUPATEN', 'EMAIL', 'PHOTO', 'IJAZAH', 'HP'];
        $data = $this->getData()->get();
        if($data){
            $rowdata = [];
            foreach ($data as $key => $val) {
                $row = [
                    $key+1, 
                    $val->no_daftar, 
                    $val->nama_depan.' '.$val->nama_belakang,
                    $val->jenis_kelamin,
                    $val->nisn,
                    $val->asal_sekolah,
                    $val->jurusan,
                    \Carbon\Carbon::parse($val->waktu)->format('d/m/Y'),
                    $val->provinsi,
                    $val->kabkota,
                    $val->email,
                    $val->photo_image ? 'Ada' : 'Tidak Ada',
                    $val->ijazah_image ? 'Ada' : 'Tidak Ada',
                    $val->hp,
                ];
                array_push($rowdata, $row);
            }

            $export = new ExportArray([
                $coltitle,
                $rowdata
            ]);
            $filename = $this->namafile ? $this->namafile.'.xlsx' : 'export_pendaftaran_maba.xlsx';
            $this->inputnamafile = null;
            return Excel::download($export, $filename);
        }
    }
}
