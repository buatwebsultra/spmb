<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\DB;
use Image;

class PendaftaranUpload extends Component
{
    use WithFileUploads;

    public $idp;
    protected $queryString = ['idp'];
    public $data;
    public $photo, $photo_image;
    public $ijazah, $ijazah_image;
    public $transkip, $transkip_image;
    public $ortu_ttd, $ortu_ttd_image, $ttd, $ttd_image;
    public $ttd64;
    public $no_daftar;
    public $message = '';
    public $isttdortu = true;

    protected $rules = [
        'photo' => 'image|max:1024',
        'ijazah' => 'image|max:1024',
        'transkip' => 'image|max:1024',
    ];
    protected $messages = [
        'photo.max' => 'UKURAN PHOTO tidak boleh lebih dari 1M',
        'ijazah.max' => 'UKURAN PHOTO tidak boleh lebih dari 1M',
        'transkip.max' => 'UKURAN PHOTO tidak boleh lebih dari 1M',
    ];

    protected $listeners = ['hapusPhoto' => 'hapusPhoto', 'hapusIjazah' => 'hapusIjazah', 'hapusTranskip' => 'hapusTranskip', 
        'updateTtd'=>'dataTtd', 
        'onClearTtd'=>'clearTtd'];

    public function dataTtd($data){
        $this->ttd64 = $data;
    }
    public function clearTtd(){
        $this->ttd64 = null;
        $this->ortu_ttd = null;
        $this->ortu_ttd_image = null;
        DB::table('d_pendaftaran')->where('id', $this->idp)->update(['ortu_ttd_image'=>null]);
    }
    public function clearTtdMaba(){
        $this->ttd64 = null;
        $this->ttd = null;
        $this->ttd_image = null;
        DB::table('d_pendaftaran')->where('id', $this->idp)->update(['ttd_image'=>null]);
    }
    public function ttdOrtu(){
        $this->isttdortu = true;
    }
    public function ttdMaba(){
        $this->isttdortu = false;
    }
    private function setTtd($data){
        $this->emit('setTtd64', $data);
    }
    // public function mount(){
    //     $data = DB::table('d_pendaftaran')->where('id', $this->idp)->first();
    //     if($data){
    //         if($data->ortu_ttd_image){
    //             $this->emit('hideCanvas');
    //         }else{
    //             $this->emit('showCanvas');
    //         }
    //     }
    // }
    public function render()
    {
        
        $errors = $this->getErrorBag();
        if(!$errors->isEmpty()){
            $this->emit('errorsInput', $errors);
        }
        $this->data = collect($this->getData($this->idp))->all();
        if($this->data){
            $this->photo_image = $this->data['photo_image'];
            $this->ijazah_image = $this->data['ijazah_image'];
            $this->transkip_image = $this->data['transkip_image'];
            $this->ortu_ttd_image = $this->data['ortu_ttd_image'];
            $this->ttd_image = $this->data['ttd_image'];
            if($this->ortu_ttd_image){
                $img = Image::make(storage_path('app/ortu_ttd/'.$this->ortu_ttd_image));
                $this->ortu_ttd =  (string) $img->encode('data-url');
                $this->setTtd($this->ortu_ttd);
                // $this->emit('hideCanvas');
            }else{
                $this->setTtd(null);
                // $this->emit('showCanvas');
            }
            
        }
        // $this->emit('reRender', $this->ttd64);
        // $this->dispatchBrowserEvent('reRender', $this->signature64);

        return view('livewire.pendaftaran-upload')
        ->extends('layouts.app')
        ->section('content');
    }
    private function getData($idp){
        $this->idp = $idp;
        return DB::table('d_pendaftaran as i')
        ->join('users as u','u.id', '=', 'i.user_id')
        ->leftJoin('m_provinsi as mp', 'mp.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mb', 'mb.id', '=', 'i.kabkota_id')
        ->leftJoin('m_agama as ma', 'ma.id', '=', 'i.agama_id')
        ->leftJoin('m_jurusan as mj', 'mj.id', '=', 'i.jurusan_id')

        ->leftJoin('m_agama as mao', 'mao.id', '=', 'i.ortu_agama_id')
        ->leftJoin('m_provinsi as mpo', 'mpo.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mbo', 'mbo.id', '=', 'i.kabkota_id')

        ->select('i.*', 'u.name as user', 'mp.nama as provinsi', 'mb.nama as kabkota', 'ma.nama as agama', 'mj.nama as jurusan',
            'mao.nama as ortu_agama', 'mpo.nama as ortu_provinsi', 'mbo.nama as ortu_kabkota')
        ->where('i.id', '=', $idp)
        ->first();
    }
    public function updatedTtd64(){
        // dd($this->ttd64);
    }
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }
    public function updatedIjazah()
    {
        $this->validate([
            'ijazah' => 'image|max:1024',
        ]);
    }
    public function updatedTranskip()
    {
        $this->validate([
            'transkip' => 'image|max:1024',
        ]);
    }
    public function uploadP(){
        if($this->photo){
            $this->validateOnly('photo');
            $no_daftar = $this->data ? $this->data['no_daftar'] : '';
            // $uuid = Str::uuid()->toString();
            $ext = $this->photo->guessExtension();
            $filename = $no_daftar.'.'.$ext;
            $this->photo->storeAs('photo', $filename);
            DB::table('d_pendaftaran')->where('id', $this->idp)->update(['photo_image'=>$filename]);
            $this->clearErrorBag();
            $this->message = 'Sukses upload Photo';
            $this->emit('showMessage', $this->message);
        }
        
    }
    public function uploadI(){
        if($this->ijazah){
            $this->validateOnly('ijazah');
            $no_daftar = $this->data ? $this->data['no_daftar'] : '';
            // $uuid = Str::uuid()->toString();
            $ext = $this->ijazah->guessExtension();
            $filename = $no_daftar.'.'.$ext;
            $this->ijazah->storeAs('ijazah', $filename);
            DB::table('d_pendaftaran')->where('id', $this->idp)->update(['ijazah_image'=>$filename]);
            $this->clearErrorBag();
            $this->message = 'Sukses upload Ijazah';
            $this->emit('showMessage', 'Sukses upload Ijazah');
        }
    }
    public function uploadT(){
        if($this->transkip){
            $this->validateOnly('transkip');
            $no_daftar = $this->data ? $this->data['no_daftar'] : '';
            // $uuid = Str::uuid()->toString();
            $ext = $this->transkip->guessExtension();
            $filename = $no_daftar.'.'.$ext;
            $this->transkip->storeAs('transkip', $filename);
            DB::table('d_pendaftaran')->where('id', $this->idp)->update(['transkip_image'=>$filename]);
            $this->clearErrorBag();
            $this->message = 'Sukses upload Transkip';
            $this->emit('showMessage', 'Sukses upload Transkip');
        }
    }
    public function uploadTtd(){
        if($this->ttd64){
            $no_daftar = $this->data ? $this->data['no_daftar'] : '';
            $ext = 'png';
            $filename = $no_daftar.'.'.$ext;

            $folder = $this->isttdortu ? 'ortu_ttd' : 'ttd';
            $path = storage_path('app/'.$folder.'/'.$filename);
            $img = Image::make($this->ttd64)->trim();
            $img->save($path);

            DB::table('d_pendaftaran')->where('id', $this->idp)->update([$folder.'_image'=>$filename]);
            if($this->isttdortu){
                $this->ortu_ttd_image = $filename;
                $this->message = 'Sukses upload Tanda Tangan Ortu';
            }else{
                $this->ttd_image = $filename;
                $this->message = 'Sukses upload Tanda Tangan Maba';
            }
           
            $this->clearErrorBag();
            
            $this->emit('showMessage', $this->message);
            $this->emit('clearCanvas');
        }
    }
    public function uploadTtdMaba(){
        if($this->ttd64){
            $no_daftar = $this->data ? $this->data['no_daftar'] : '';
            $ext = 'png';
            $filename = $no_daftar.'.'.$ext;
            $path = storage_path('app/ttd/'.$filename);
            $img = Image::make($this->ttd64)->trim();
            $img->save($path);

            DB::table('d_pendaftaran')->where('id', $this->idp)->update(['ttd_image'=>$filename]);
            $this->ttd_image = $filename;
            $this->clearErrorBag();
            $this->message = 'Sukses upload Tanda Tangan Maba';
            $this->emit('showMessage', $this->message);
            $this->emit('clearCanvas');
        }
    }
    public function confirmHapusPhoto(){
        $this->emit('confirmhapusPhoto');
    }
    public function confirmHapusIjazah(){
        $this->emit('confirmhapusIjazah');
    }
    public function confirmHapusTranskip(){
        $this->emit('confirmhapusTranskip');
    }
    public function hapusPhoto(){
        if (File::exists(public_path('app/photo/'.$this->data['photo_image']))) {
            File::delete(public_path('app/photo/'.$this->data['photo_image']));
        }
        DB::table('d_pendaftaran')->where('id', '=', $this->idp)->update(['photo_image'=>null]);
        $this->photo = null; $this->photo_image = null;
    }
    public function hapusIjazah(){
        if (File::exists(public_path('app/ijazah/'.$this->data['ijazah_image']))) {
            File::delete(public_path('app/ijazah/'.$this->data['ijazah_image']));
        }
        DB::table('d_pendaftaran')->where('id', '=', $this->idp)->update(['ijazah_image'=>null]);
        $this->ijazah = null; $this->ijazah_image = null;
    }
    public function hapusTranskip(){
        if (File::exists(public_path('app/transkip/'.$this->data['transkip_image']))) {
            File::delete(public_path('app/transkip/'.$this->data['transkip_image']));
        }
        DB::table('d_pendaftaran')->where('id', '=', $this->idp)->update(['transkip_image'=>null]);
        $this->transkip = null; $this->transkip_image = null;
    }
    public function clearErrorBag(){
        $this->resetErrorBag();
    }
}
