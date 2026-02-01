<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PendaftaranInput extends Component
{
    use WithFileUploads;
    public $idp;
    protected $queryString = ['idp'];
    public $photo, $ijazah;

    public $nisn, $no_daftar, $nama_depan, $nama_belakang, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $hp, $email, 
        $provinsi_id, $kabkota_id, $kodepos, $warganegara = 'INDONESIA', $agama_id, $kecamatan_id, $kelurahan_id, $rt, $rw, $dusun, $nik, $jenis_tinggal_id;
    public $asal_sekolah, $asal_sekolah_npsn, $tahun_lulus, $jenis_daftar, $nama_pt_asal, $kode_pt_asal, $nama_ps_asal, $kode_ps_asal;

    public $waktu, $waktu_update, $user_id, $user_id_update, $jurusan_id, $photo_image, $ijazah_image, $transkip_image,  $jurusan_id2, $jurusan_id3;

    public $ortu_nama_depan, $ortu_nama_belakang, $jortu_enis_kelamin, $ortu_tempat_lahir, $ortu_tanggal_lahir, $ortu_alamat, 
        $ortu_provinsi_id, $ortu_kabkota_id, $ortu_kodepos, $ortu_warganegara = 'INDONESIA', $ortu_agama_id, $ortu_pekerjaan, $ortu_hubungan = 'ANAK KANDUNG',
        $ortu_ttd_image, $ortu_jenis_kelamin;

    public $setuju;
    public $nisn_exists;

    public $provinsi = [], $kabkota = [], $jurusan = [], $jurusan2 = [], $jurusan3 = [], $agama = [], $kecamatan=[], $kelurahan=[], $jenis_tinggal=[];
    public $provinsio = [], $kabkotao = [];

    public $tab1 = 'true';
    public $tab2 = 'false';
    public $tab3 = 'false';
    public $tab4 = 'false';

    public $new_user = true;
    public $u_email, $u_pass;
    public $status_jadwal;

    protected $rules = [
        'nama_depan' => 'required',
        'nisn' => 'required',//|unique:d_pendaftaran,nisn',
        'hp' => 'required',
        'email' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'agama_id' => 'required',
        'jurusan_id' => 'required',
        'jenis_kelamin' => 'required',
        // 'asal_sekolah' => 'required',
        // 'asal_sekolah_npsn' => 'required',
        // 'tahun_lulus' => 'required',
        // 'photo_image' => 'required',
        // 'ijazah_image' => 'required',
        'ortu_nama_depan' => 'required',
        'ortu_agama_id' => 'required',
        'ortu_jenis_kelamin' => 'required',
        'jenis_daftar' => 'required',
    ];
    protected $messages = [
        'nama_depan.required' => 'Nama tidak boleh kosong',
        // 'nisn.required' => 'NISN tidak boleh kosong',
        // 'nisn.unique' => 'NISN sudah terdaftar',
        'hp.required' => 'NO HP tidak boleh kosong',
        'email.required' => 'EMAIL tidak boleh kosong',
        'jenis_kelamin.required' => 'JENIS KELAMIN tidak boleh kosong',
        'jurusan_id.required' => 'JURUSAN tidak boleh kosong',
        'tempat_lahir.required' => 'TEMPAT LAHIR tidak boleh kosong',
        'tanggal_lahir.required' => 'TANGGAL LAHIR tidak boleh kosong',
        'agama_id.required' => 'AGAMA tidak boleh kosong',

        // 'asal_sekolah.required' => 'ASAL SEKOLAH tidak boleh kosong',
        // 'asal_sekolah_npsn.required' => 'NPSN tidak boleh kosong',
        // 'tahun_lulus.required' => 'TAHUN LULUS tidak boleh kosong',
    
        'ortu_nama_depan.required' => 'NAMA ORTU/WALI tidak boleh kosong',
        'ortu_agama_id.required' => 'AGAMA ORTU/WALI tidak boleh kosong',
        'ortu_jenis_kelamin.required' => 'JENIS KELAMIN ORTU/WALI tidak boleh kosong',

        'jenis_daftar.required' => 'JENIS DAFTAR tidak boleh kosong',
    ];
    public function mount(){
        if (Auth::check()) {
            $this->email =  auth()->user()->email;
            $this->new_user = false;
        }
        // $this->rules['nisn'] = 'required|unique:d_pendaftaran,nisn,'.$this->idp;
        //['required', Rule::unique('d_pendaftaran')->ignore($this->idp)];// 
        $this->jenis_daftar = 0;
        if($this->idp!==null){
            $this->getData($this->idp);
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }
    public function updatedIjazah(){
        $this->validate([
            'file' => 'file|mimes:pdf|max:1024',
        ]);
    }
    public function updatedNisn(){
        if(!$this->idp>0){
            $data = DB::table('d_pendaftaran')->where('nisn', '=', $this->nisn)->first();
            $this->nisn_exists = false;// $data ? true : false;
        }
        $this->step1();
    }
    public function updatedJenisKelamin(){
        $this->step1();
    }
    public function updatedAgamaId(){
        $this->step1();
    }
    public function updatedProvinsiId(){
        $this->step1();
    }
    public function updatedKabkotaId(){
        $this->step1();
    }
    public function updatedTempatLahir(){
        $this->step1();
    }
    public function updatedTanggalLahir(){
        $this->step1();
    }
    public function updatedHp(){
        $this->step1();
    }
    public function updatedEmail(){
        $this->step1();
    }

    public function updatedJurusanId(){
        $this->jurusan_id2 = '';
        $this->jurusan_id3 = '';
        $this->step2();
    }
    public function updatedJurusanId2(){
        $this->jurusan_id3 = '';
        $this->step2();
    }
    public function updatedJurusanId3(){
        $this->step2();
    }
    public function updatedAsalSekolah(){
        $this->step2();
    }
    public function updatedAsalSekolahNpsn(){
        $this->step2();
    }
    public function updatedTahunLulus(){
        $this->step2();
    }
    public function updatedJenisDaftar(){
        $this->step2();
    }

    

    public function updatedOrtuProvinsiId(){
        $this->step3();
    }
    public function updatedOrtuKabkotaId(){
        $this->step3();
    }
    public function updatedOrtuNamaDepan(){
        $this->step3();
    }
    public function updatedOrtuJenisKelamin(){
        $this->step3();
    }
    public function updatedOrtuAgamaId(){
        $this->step3();
    }
    public function updatedSetuju(){
        $this->step3();
    }
    
    private function step1(){
        $this->tab1 = 'true'; $this->tab2 = 'false'; $this->tab3 = 'false'; 
        $this->emit('updatedStep', 0);
    }
    private function step2(){
        $this->tab1 = 'false'; $this->tab2 = 'true'; $this->tab3 = 'false'; 
        $this->emit('updatedStep', 1);
    }
    private function step3(){
        $this->tab1 = 'false'; $this->tab2 = 'false'; $this->tab3 = 'true'; 
        $this->emit('updatedStep', 2);
    }
    public function step1Valid(){
        return ($this->nama_depan && $this->nisn & $this->jenis_kelamin && $this->tempat_lahir
             && $this->tanggal_lahir && $this->agama_id && $this->hp && $this->email && (!$this->nisn_exists));
    }
    public function step2Valid(){
        return ($this->asal_sekolah && $this->asal_sekolah_npsn && $this->jurusan_id && $this->tahun_lulus);
    }
    public function step3Valid(){
        return ($this->ortu_nama_depan && $this->ortu_agama_id && $this->ortu_jenis_kelamin && $this->setuju);
    }
    public function allStepValid(){
        return $this->step1Valid() && $this->step2Valid() && $this->step3Valid();
    }
    
    
    public function render()
    {
        $errors = $this->getErrorBag();
        if(!$errors->isEmpty()){
            $this->emit('errorsInput', $errors);
        }
        $this->agama = DB::table('m_agama')->get();
        $this->provinsi = DB::table('m_provinsi')->get();
        $this->jurusan = DB::table('m_jurusan')->get();
        $this->jenis_tinggal = DB::table('m_jenis_tinggal')->get();

        $this->jurusan2 = $this->jurusan_id ? DB::table('m_jurusan')->where('id', '<>', $this->jurusan_id)->get() : [];
        $this->jurusan3 = $this->jurusan_id2 ? DB::table('m_jurusan')->where('id', '<>', $this->jurusan_id)->where('id', '<>', $this->jurusan_id2)->get() : [];

        if($this->provinsi_id) $this->kabkota = DB::table('m_kabkota')->where('provinsi_id', '=', $this->provinsi_id)->get();
        if($this->kabkota_id) $this->kecamatan = DB::table('m_kecamatan')->where('kabkota_id', '=', $this->kabkota_id)->get();
        if($this->kecamatan_id) $this->kelurahan = DB::table('m_kelurahan')->where('kecamatan_id', '=', $this->kecamatan_id)->get();

        $this->provinsio = DB::table('m_provinsi')->get();
        if($this->ortu_provinsi_id) $this->kabkotao = DB::table('m_kabkota')->where('provinsi_id', '=', $this->ortu_provinsi_id)->get();

        return view('livewire.pendaftaran-input')
        ->extends('layouts.app')
        ->section('content');
    }
    public function clearErrorBag(){
        $this->resetErrorBag();
    }
    public function getData($id){
        $data = DB::table('d_pendaftaran as i')
        ->join('users as u','u.id', '=', 'i.user_id')
        ->leftJoin('m_provinsi as mp', 'mp.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mb', 'mb.id', '=', 'i.kabkota_id')
        ->select('i.*', 'u.name as user', 'mp.nama as provinsi', 'mb.nama as kabkota')
        ->where('i.id', '=', $id)
        ->first();
        if($data){
            $this->idp = $id;
            $this->nama_depan = $data->nama_depan;
            $this->nama_belakang = $data->nama_belakang;
            $this->nisn = $data->nisn;
            $this->no_daftar = $data->no_daftar;

            $this->alamat = $data->alamat;
            $this->jenis_kelamin= $data->jenis_kelamin;
            $this->tempat_lahir = $data->tempat_lahir;
            $this->tanggal_lahir = $data->tanggal_lahir;
            $this->agama_id = $data->agama_id;
            $this->warganegara = $data->warganegara;

            $this->provinsi_id = $data->provinsi_id;
            $this->kabkota_id = $data->kabkota_id;
            $this->kodepos = $data->kodepos;
            $this->kecamatan_id = $data->kecamatan_id;
            $this->kelurahan_id = $data->kelurahan_id;
            $this->rt = $data->rt;
            $this->rw = $data->rw;
            $this->dusun = $data->dusun;
            $this->nik = $data->nik;
            $this->jenis_tinggal_id = $data->jenis_tinggal_id;

            $this->tahun_lulus = $data->tahun_lulus;
            $this->asal_sekolah = $data->asal_sekolah;
            $this->asal_sekolah_npsn = $data->asal_sekolah_npsn;
            $this->jenis_daftar  = $data->jenis_daftar;
            $this->kode_pt_asal = $data->kode_pt_asal;
            $this->nama_pt_asal = $data->nama_pt_asal;
            $this->kode_ps_asal = $data->kode_ps_asal;
            $this->nama_ps_asal = $data->nama_ps_asal;

            $this->ijazah_image = $data->ijazah_image;
            $this->photo_image = $data->photo_image;
            $this->transkip_image = $data->transkip_image;
            
            $this->setuju = $data->setuju;
            

            $this->jurusan_id = $data->jurusan_id;
            $this->jurusan_id2 = $data->jurusan_id2;
            $this->jurusan_id3 = $data->jurusan_id3;
            $this->hp = $data->hp;
            $this->email  = $data->email;

            $this->ortu_nama_depan = $data->ortu_nama_depan;
            $this->ortu_nama_belakang = $data->ortu_nama_belakang;

            $this->ortu_alamat = $data->ortu_alamat;
            $this->ortu_provinsi_id = $data->ortu_provinsi_id;
            $this->ortu_kabkota_id = $data->ortu_kabkota_id;
            $this->ortu_kodepos = $data->ortu_kodepos;

            $this->ortu_jenis_kelamin = $data->ortu_jenis_kelamin;
            $this->ortu_tempat_lahir = $data->ortu_tempat_lahir;
            $this->ortu_tanggal_lahir = $data->ortu_tanggal_lahir;
            $this->ortu_agama_id = $data->ortu_agama_id;
            $this->ortu_warganegara = $data->ortu_warganegara;
            $this->ortu_pekerjaan = $data->ortu_pekerjaan;
            $this->ortu_ttd_image = $data->ortu_ttd_image;
            $this->ortu_hubungan = $data->ortu_hubungan;

            $this->status_jadwal = $data->status_jadwal;
        }
    }
    private function genNoDaftar($jurusan_id){
        $jur = DB::table('m_jurusan')->where('id', '=', $jurusan_id)->first();
        if($jur){
            $kode = $jur->kode;
            $tahun = \Carbon\Carbon::now()->format('Y');
            $pen = DB::table('d_pendaftaran')->where('jurusan_id', '=', $jurusan_id)->select('no_daftar')->orderBy('no_daftar', 'desc')->first();
            $lastnd = $pen ? $pen->no_daftar : '';
            $nodaf = '0001';
            if($lastnd){
                $lastno = substr($lastnd, 8, 4);
                $num  = ((int) $lastno) + 1;
                $nodaf = str_pad((string) $num, 4, '0', STR_PAD_LEFT);
            }
            return $kode.$tahun.$nodaf;
        }
    }

    public function save(){


        $this->step3();
        if($this->idp>0){
            $this->rules['nisn'] = 'required|unique:d_pendaftaran,nisn,'.$this->idp;
        }
        $this->validate();

        if(!$this->new_user){
            $user = auth()->user();
        }else{
            $user = null;
        }
        $message = 'Sukses tambah data Pendaftaran';
        $this->no_daftar = $this->genNoDaftar($this->jurusan_id);
        $data = [
            'nama_depan' => $this->nama_depan,
            'nama_belakang' => $this->nama_belakang,
            'nisn' => $this->nisn,
            'no_daftar' => $this->no_daftar,

            'alamat' => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama_id' => $this->agama_id,
            'warganegara' => $this->warganegara,

            'provinsi_id' => $this->provinsi_id,
            'kabkota_id' => $this->kabkota_id,
            'kodepos' => $this->kodepos,
            'kecamatan_id' => $this->kecamatan_id,
            'kelurahan_id' => $this->kelurahan_id,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'dusun' => $this->dusun,
            'nik' => $this->nik,
            'jenis_tinggal_id' => $this->jenis_tinggal_id,

            'tahun_lulus' => $this->tahun_lulus,
            'asal_sekolah' => $this->asal_sekolah,
            'asal_sekolah_npsn' => $this->asal_sekolah_npsn,
            'jenis_daftar' => $this->jenis_daftar,
            'kode_pt_asal' => $this->kode_pt_asal,
            'nama_pt_asal' => $this->nama_pt_asal,
            'kode_ps_asal' => $this->kode_ps_asal,
            'nama_ps_asal' => $this->nama_ps_asal,

            'ijazah_image' => $this->ijazah_image,
            'photo_image' => $this->photo_image,

            'setuju' => $this->setuju,
            

            // 'jurusan_id' => $this->jurusan_id,
            // 'jurusan_id2' => $this->jurusan_id2,
            // 'jurusan_id3' => $this->jurusan_id3,

            'hp' => $this->hp,
            'email' => $this->email,

            'ortu_nama_depan' => $this->ortu_nama_depan,
            'ortu_nama_belakang' => $this->ortu_nama_belakang,

            'ortu_alamat' => $this->ortu_alamat,
            'ortu_provinsi_id' => $this->ortu_provinsi_id,
            'ortu_kabkota_id' => $this->ortu_kabkota_id,
            'ortu_kodepos' => $this->ortu_kodepos,

            'ortu_jenis_kelamin' => $this->ortu_jenis_kelamin,
            'ortu_tempat_lahir' => $this->ortu_tempat_lahir,
            'ortu_tanggal_lahir' => $this->ortu_tanggal_lahir,
            'ortu_agama_id' => $this->ortu_agama_id,
            'ortu_warganegara' => $this->ortu_warganegara,
            'ortu_pekerjaan' => $this->ortu_pekerjaan,
            'ortu_ttd_image' => $this->ortu_ttd_image,
            'ortu_hubungan' => $this->ortu_hubungan,
        ];

        if($this->status_jadwal==null){
            $data['jurusan_id'] = $this->jurusan_id;
            $data['jurusan_id2'] = $this->jurusan_id2 ? $this->jurusan_id2 : 0;
            $data['jurusan_id3'] = $this->jurusan_id3 ? $this->jurusan_id3 : 0;
        }
        

        if($this->idp > 0){
            $data['waktu_update'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $data['user_id_update'] = $user ? $user->id : null;
            DB::table('d_pendaftaran')->where('id', '=', $this->idp)->update($data);
        }else{
            $data['waktu'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $data['user_id'] = $user ? $user->id : null;
            $this->idp = DB::table('d_pendaftaran')->insertGetId($data);
        }

        if (Auth::check()) {
            DB::table('users')->where('id', '=', auth()->user()->id)->update(['pendaftaran_id'=>$this->idp]);
        }

        // if($this->photo){
        //     $uuid = Str::uuid()->toString();
        //     $ext = $this->photo->guessExtension();
        //     $filename = $uuid.'.'.$ext;
        //     $this->photo->storeAs('images', $filename);
        //     DB::table('d_pendaftaran')->where('id', $this->idp)->update(['photo_image'=>$filename]);
        // }
        // if($this->ijazah){
        //     $uuid = Str::uuid()->toString();
        //     $ext = $this->photo->guessExtension();
        //     $filename = $uuid.'.'.$ext;
        //     $this->photo->storeAs('images', $filename);
        //     DB::table('d_pendaftaran')->where('id', $this->idp)->update(['ijazah_image'=>$filename]);
        // }
        
        
        
        if($this->new_user){
            $message = 'Silahkan login, Username dan Password telah dikirim ke Email yang anda masukan pada pendaftaran';
            session()->flash('message', $message);
            return redirect()->to('/login');
        }else{
            session()->flash('message', $message);
            if(!$this->photo_image || !$this->ijazah_image){
                return redirect()->to('/pendaftaran/upload?idp='.$this->idp);
            }else{
                if(auth()->user()->level_id==1){
                    return redirect()->to('/pendaftaran/show?idp='.$this->idp);
                }else{
                    return redirect()->to('/home');
                }
            }
        }
        
        
    }
}
