<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DaftarUlangForm extends Component
{
    public $no_daftar;
    public $idp;
    protected $queryString = ['idp'];
    // public $data;
    public $setuju;
    public $jurusan_id;
    public $nama_ayah, $nik_ayah, $tgl_lahir_ayah, $pekerjaan_ayah;
    public $nama_ibu, $nik_ibu;
    public $biaya;

    protected $rules = [
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
    ];
    protected $messages = [
        'nama_ayah.required' => 'Nama Ayah tidak boleh kosong',
        'nama_ibu.required' => 'Nama Ibu tidak boleh kosong',
    ];


    public function render()
    {
        $data = null;
        if($this->idp != null){
            $setting = DB::table('d_setting')->first();
            $data = DB::table('d_pendaftaran as i')
            ->join('users as u','u.id', '=', 'i.user_id')
            ->leftJoin('m_provinsi as mp', 'mp.id', '=', 'i.provinsi_id')
            ->leftJoin('m_kabkota as mb', 'mb.id', '=', 'i.kabkota_id')
            ->leftJoin('m_agama as ma', 'ma.id', '=', 'i.agama_id')
            ->leftJoin('m_jurusan as mj', 'mj.id', '=', 'i.jurusan_id_lulus')

            ->leftJoin('m_agama as mao', 'mao.id', '=', 'i.ortu_agama_id')
            ->leftJoin('m_provinsi as mpo', 'mpo.id', '=', 'i.provinsi_id')
            ->leftJoin('m_kabkota as mbo', 'mbo.id', '=', 'i.kabkota_id')
            ->select('i.*',  'u.name as user', 'mp.nama as provinsi', 'mb.nama as kabkota', 'ma.nama as agama', 'mj.nama as jurusan',
            'mao.nama as ortu_agama', 'mpo.nama as ortu_provinsi', 'mbo.nama as ortu_kabkota')
            ->where('i.id', '=', $this->idp)
            ->first();
            $data->ta_pendaftaran = $setting->ta_pendaftaran;
            $this->jurusan_id = $data->jurusan_id_lulus;
            $this->biaya = ($setting->biaya_spp + $setting->biaya_pendidikan + $setting->biaya_almamater + $setting->biaya_lain);

        }
        return view('livewire.daftar-ulang-form', ['data' => $data, 'setting'=>collect($setting)->all()])
        ->extends('layouts.app')
        ->section('content');
    }
    public function save(){
        $this->validate();
        $nim = $this->generateNim($this->jurusan_id);
        $idu = DB::table('d_daftar_ulang')->insertGetId([
            'pendaftaran_id' => $this->idp,
            'jurusan_id' => $this->jurusan_id,
            'nim' => $nim,
            'waktu' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => auth()->user()->id,
            'setuju' => $this->setuju,
            'biaya' => $this->biaya,
        ]);

        DB::table('d_pendaftaran')->where('id', '=', $this->idp)
            ->update([
                'status_daftar_ulang'=>$idu, 
                'nim'=>$nim,

                'nama_ayah' => $this->nama_ayah,
                'nik_ayah' => $this->nik_ayah,
                'tgl_lahir_ayah' => $this->tgl_lahir_ayah,
                'pekerjaan_ayah' => $this->pekerjaan_ayah,
                'nama_ibu' => $this->nama_ibu,
                'nik_ibu' => $this->nik_ayah,

        ]);
        session()->flash('message', 'Sukses daftar ulang');
        if(auth()->user()->level_id>1){
            return redirect()->to('/home');
        }else{
            return redirect()->to('/daftarulang');
        }
        
    }
    private function generateNim($jurusan_id){
        $jur = DB::table('m_jurusan')->where('id', '=', $jurusan_id)->first();
        $kode = $jur->kode_nim;
        $tahun = \Carbon\Carbon::now()->format('y');
        $pen = DB::table('d_daftar_ulang')->where('jurusan_id', '=', $jurusan_id)->orderBy('nim', 'desc')->first();
        $lastnd = $pen ? $pen->nim : '';
        $nodaf = '001';
        if($lastnd){
            $lastno = substr($lastnd, 8, 3);
            $num  = ((int) $lastno) + 1;
            $nodaf = str_pad((string) $num, 3, '0', STR_PAD_LEFT);
        }
        return $kode.$tahun.$nodaf;

        //P212023001
    }
}
