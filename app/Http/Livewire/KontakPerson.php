<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class KontakPerson extends Component
{
    public $nama = '';
    public $hp = '';
    public function render()
    {
        $set = DB::table('d_setting')->first();
        $this->nama = $set->kontak_nama;
        $this->hp = $set->kontak_hp;
        
        return view('livewire.kontak-person');
    }
}
