<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    //
    public function landing(){
        return view('landing', [
            'setting' => DB::table('d_setting')->first(),
        ]);
    }
}
