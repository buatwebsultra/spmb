<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CariPengumuman extends Component
{
    public $no_daftar;
    public $data = null;
    public $oncari = false;
    public $ta = '';
    public $link_syarat_daftar_ulang = '#';
    public $instansi = "";
    public function render()
    {
        $set = DB::table('d_setting')->first();
        $this->ta = $set->ta_pendaftaran;
        $this->link_syarat_daftar_ulang = $set->link_syarat_daftar_ulang;
        $this->instansi = $set->instansi;

        return view('livewire.cari-pengumuman');
    }
    public function cari(){
        $this->oncari = true;
        $this->getData();
    }
    public function tutup(){
        $this->oncari = false;
        $this->data = null;
    }
    public function getData(){
        $this->data = null;
        if($this->no_daftar){
            $data = DB::table('d_pendaftaran as p')
                ->join('d_seleksi_hasil as sh', 'sh.pendaftaran_id', '=', 'p.id')
                ->join('m_status as ms', 'ms.id', '=', 'sh.status')
                ->join('m_jurusan as mj', 'mj.id', '=', 'sh.jurusan_id')
                ->select('p.*', 'mj.nama as jurusan', 
                    'sh.tanggal_pengumuman', 'sh.waktu as waktu_pengumuman', 'sh.nilai', 'sh.status',
                    'ms.nama as status_keterangan')
                ->where('p.no_daftar', '=', $this->no_daftar)
                ->first();
            $this->data = $data ? collect($data)->all() : [];
            if($data){
                $data->qrcode = url('/qr/'.$data->no_daftar);
                $this->data = collect($data)->all();
            }

        }
        
    }

}
