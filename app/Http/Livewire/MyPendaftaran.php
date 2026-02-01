<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyPendaftaran extends Component
{
    public $idp;
    public function render()
    {
        $user = auth()->user();
        $data = DB::table('d_pendaftaran')->where('user_id', '=', $user->id)->orderBy('id', 'desc')->first();
        if($data){
            $this->idp = $data->id;
        }
        return view('livewire.my-pendaftaran');
    }
}
