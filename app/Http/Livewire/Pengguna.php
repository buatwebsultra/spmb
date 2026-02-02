<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
class Pengguna extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perpage = 5;
    public $fillevel;
    public $pillevel = [];
    public $query;
    public $email, $password, $name;
    public $idu, $jurusan_id;
    protected $listeners = ['hapusUser' => 'hapusUser'];
    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        // 'password' => 'required',
    ];
    public $messages = [
        'name.required' => 'NAMA tidak boleh kosong',
        'email.required' => 'EMAIL tidak boleh kosong',
        'email.email' => 'NAMA EMAIL harus benar',
        'password.required' => 'PASSWORD tidak boleh kosong',
    ];

    public function render()
    {
        if (auth()->user()->jurusan_id > 0) {
            $this->pillevel = DB::table('m_level')->where('id', 4)->get();
        } else {
            $this->pillevel = DB::table('m_level')->whereIn('id', [1,4])->orderBy('id')->get();
        }
        
        return view('livewire.pengguna', [
            'data'=>$this->getData(),
            'jurusan' => DB::table('m_jurusan')->get()
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function getData(){
        $cari = $this->query;
        $data = DB::table('users as u')->orderBy('u.level_id')
            ->leftJoin('m_level as ml', 'ml.id', '=', 'u.level_id')
            ->leftJoin('m_jurusan as mj', 'mj.id', '=', 'u.jurusan_id')
            ->leftJoin('d_pendaftaran as p', 'p.id', '=', 'u.pendaftaran_id')
            ->select('u.*', 'ml.nama as level', 'mj.nama as jurusan_nama', 'p.nama_depan', 'p.nama_belakang', 'p.photo_image', 'p.no_daftar', 'p.nim');

        if (auth()->user()->jurusan_id > 0) {
            $data = $data->where('u.level_id', 4)
                         ->where('p.jurusan_id', auth()->user()->jurusan_id);
        }

        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('p.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('u.name', 'like', '%'.$cari.'%');
                $q->orWhere('u.email', 'like', '%'.$cari.'%');
            });
        }
        if($this->fillevel>0){
            $data = $data->where('u.level_id', '=', $this->fillevel);
        }
        $data = $data->paginate($this->perpage);

        return $data;
    }
    public function tambah(){
        if (auth()->user()->jurusan_id > 0) return;
        $this->email = null;
        $this->password = null;
        $this->jurusan_id = null;
        $this->rules['password'] = 'required';
    }
    public function edit($idu){
        $data = DB::table('users as u')
            ->leftJoin('d_pendaftaran as p', 'p.id', '=', 'u.pendaftaran_id')
            ->select('u.*', 'p.jurusan_id as p_jurusan_id')
            ->where('u.id', '=', $idu)->first();
            
        if($data){
            if (auth()->user()->jurusan_id > 0) {
                if ($data->level_id != 4 || $data->p_jurusan_id != auth()->user()->jurusan_id) {
                    return $this->clear();
                }
            }
            $this->idu = $idu;
            $this->name = $data->name;
            $this->email = $data->email;
            $this->jurusan_id = $data->jurusan_id;
            $this->password = null;
            $this->rules['password'] = '';
        }else{
            $this->clear();
        }
    }
    public function save(){
        if (auth()->user()->jurusan_id > 0 && !$this->idu) return;

        $this->validate();

        if (auth()->user()->jurusan_id > 0) {
             $data = [];
             if($this->password){
                $check = DB::table('users as u')
                    ->join('d_pendaftaran as p', 'p.id', '=', 'u.pendaftaran_id')
                    ->where('u.id', $this->idu)
                    ->where('u.level_id', 4)
                    ->where('p.jurusan_id', auth()->user()->jurusan_id)
                    ->first();
                
                if($check){
                    $data['password'] = Hash::make($this->password);
                    DB::table('users')->where('id', '=', $this->idu)->update($data);
                    $msg = 'Sukses reset password MABA';
                } else {
                    $msg = 'Akses ditolak atau data tidak ditemukan';
                }
             } else {
                $msg = 'Tidak ada perubahan';
             }
        } else {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'jurusan_id' => $this->jurusan_id == '' ? null : $this->jurusan_id,
            ];

            if($this->password){
                $data['password'] = Hash::make($this->password);
            }

            if($this->idu>0){
                DB::table('users')->where('id', '=', $this->idu)->update($data);
                $msg = 'Sukses update data user';
            }else{
                $data['level_id'] = 1;
                $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                DB::table('users')->insert($data);
                $msg = 'Sukses tambah data user';
            }
        }
        $this->clear();
        session()->flash('message', $msg);
    }
    public function confirmHapus($idu){
        if (auth()->user()->jurusan_id > 0) return;
        $data = DB::table('users')->where('id', '=', $idu)->where('id', '>', 1)->where('pendaftaran_id',  '=', null)->first();
        if($data){
            $this->idu = $data->id;
            $nama = $data->name;
            $this->emit('confirmHapus', 'Data user '.$nama.', Yakin akan dihapus?');
        }
    }
    public function hapusUser(){
        if (auth()->user()->jurusan_id > 0) return;
        DB::table('users')->where('id', '=', $this->idu)->where('id', '>', 1)->delete();
        session()->flash('message', 'Sukses hapus data user');
        $this->clear();
    }
    public function clear(){
        $this->idu = null;
        $this->email = null;
        $this->password = null;
        $this->name = null;
        $this->jurusan_id = null;
    }
}
