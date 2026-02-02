<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Setting extends Component
{
    use WithFileUploads;
 
    public $photo, $logo;

    public $about, $selamat_datang,  $bg_head, $informasi, $profil, $head_welcome;
    public $daftar_ulang_awal, $daftar_ulang_akhir;
    public $nama_bank, $nama_rekening, $nomor_rekening;
    public $biaya_pendaftaran, $biaya_spp, $biaya_pendidikan, $biaya_almamater, $biaya_lain;
    public $ta_pendaftaran, $buka_pendaftaran, $tutup_pendaftaran, $link_syarat_daftar_ulang, $logo_app, $instansi;
    public $kontak_nama, $kontak_hp;


    public function mount(){
        if (auth()->user()->jurusan_id > 0) {
            abort(403);
        }
        $this->getData();
    }
    public function render()
    {
        return view('livewire.setting')
        ->extends('layouts.app')
        ->section('content');
    }
    private function getData(){
        $data = DB::table('d_setting')->first();
        $this->bg_head = $data->bg_head;
        $this->logo_app = $data->logo_app;
        $this->selamat_datang = $data->selamat_datang;
        $this->head_welcome = $data->head_welcome;
        $this->ta_pendaftaran = $data->ta_pendaftaran;
        $this->buka_pendaftaran = $data->buka_pendaftaran;
        $this->tutup_pendaftaran = $data->tutup_pendaftaran;

        $this->biaya_pendaftaran = $data->biaya_pendaftaran;
        $this->biaya_spp = $data->biaya_spp;
        $this->biaya_pendidikan = $data->biaya_pendidikan;
        $this->biaya_almamater = $data->biaya_almamater;
        $this->biaya_lain = $data->biaya_lain;

        $this->nama_bank = $data->nama_bank;
        $this->nama_rekening = $data->nama_rekening;
        $this->nomor_rekening = $data->nomor_rekening;
        $this->daftar_ulang_awal = $data->daftar_ulang_awal;
        $this->daftar_ulang_akhir = $data->daftar_ulang_akhir;

        $this->informasi = $data->informasi;
        $this->profil = $data->profil;
        $this->link_syarat_daftar_ulang = $data->link_syarat_daftar_ulang;
        $this->instansi = $data->instansi;

        $this->kontak_nama = $data->kontak_nama;
        $this->kontak_hp = $data->kontak_hp;


    }

    public function save(){

        // Sanitize HTML input using Purifier
        $this->informasi = clean($this->informasi);
        $this->profil = clean($this->profil);
        
        DB::table('d_setting')->where('id', '=', 1)->update([
            'selamat_datang' => $this->selamat_datang,
            'head_welcome' => $this->head_welcome,
            'informasi' => $this->informasi,
            'profil' => $this->profil,
            'ta_pendaftaran' => $this->ta_pendaftaran, 
            'buka_pendaftaran' => $this->buka_pendaftaran, 
            'tutup_pendaftaran' => $this->tutup_pendaftaran,

            'biaya_pendaftaran' => $this->biaya_pendaftaran, 
            'biaya_spp' => $this->biaya_spp,
            'biaya_pendidikan' => $this->biaya_pendidikan,
            'biaya_almamater' => $this->biaya_almamater,
            'biaya_lain' => $this->biaya_lain,

            'nama_bank' => $this->nama_bank, 
            'nama_rekening' => $this->nama_rekening, 
            'nomor_rekening' => $this->nomor_rekening,

            'daftar_ulang_awal' => $this->daftar_ulang_awal, 
            'daftar_ulang_akhir' => $this->daftar_ulang_akhir,
            'link_syarat_daftar_ulang' => $this->link_syarat_daftar_ulang,
            'instansi' => $this->instansi,
            'kontak_nama' => $this->kontak_nama,
            'kontak_hp' => $this->kontak_hp,

        ]);
        if($this->photo){
            $ext = $this->photo->guessExtension();
            $uuid = Str::uuid()->toString();
            $filename = $uuid.'.'.$ext;
            $this->photo->storeAs('bghead', $filename);
            DB::table('d_setting')->update(['bg_head'=>$filename]);
        }
        if($this->logo){
            $ext = $this->logo->guessExtension();
            $uuid = Str::uuid()->toString();
            $filename = $uuid.'.'.$ext;
            $this->logo->storeAs('logo', $filename);
            DB::table('d_setting')->update(['logo_app'=>$filename]);
        }
        session()->flash('message', 'Sukses update data pengaturan');
        $this->dispatchBrowserEvent('DOMContentLoaded');
    }

}
