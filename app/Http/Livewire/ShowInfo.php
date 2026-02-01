<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowInfo extends Component
{
    public $judul;
    public $keterangan;
    public $tampil = 1;
    public $waktu;
    public $user;
    public $idd;
    public $user_id;
    public $image;
    public $file;


    public function mount($id){
        $user = auth()->user();
        $this->user_id = $user ? $user->id : null;
        $this->idd = $id;// session()->get('id', null);
        if($this->idd){
            $data = DB::table('d_info as i')
                ->join('users as u', 'u.id', '=', 'i.user_id')
                ->leftJoin('d_image_info as ii', 'ii.info_id', '=', 'i.id')
                ->leftJoin('d_file_info as fi', 'fi.info_id', '=', 'i.id')
                ->select('i.*', 'u.name as user', 'ii.filename as image', 'fi.filename as file')
                ->where('i.id', '=', $this->idd)
                ->first();
        
            if($data){
                $this->judul = $data->judul;
                $this->keterangan = $data->keterangan;
                $this->tampil = $data->tampil;
                $this->waktu = $data->waktu;
                $this->user = $data->user;
                $this->file = $data->file;
                $this->image = $data->image;
            }
        }
    }


    public function render()
    {
        $layout = 'layouts.app';
        if(!$this->user_id){
            $layout = 'welcome';
        }
        return view('livewire.show-info')
        ->extends($layout, ['id'=>$this->idd])
        ->section('content');
    }
}
