<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Seleksi extends Component
{

    public function render()
    {
        $setting = DB::table('d_setting')->first();

        return view('livewire.seleksi',[
            'jadwal' => $this->getDataJadwal(),
            'hasil' => $this->getDataHasil(),
            'setting' => $setting,
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function getDataJadwal(){
        $data = DB::table('d_pendaftaran as i')
        
            ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
            ->leftJoin('d_seleksi_jadwal as sj','sj.pendaftaran_id','=', 'i.id')
            ->leftJoin('m_jurusan as j', 'j.id', '=', 'sj.jurusan_id');
        
        if (auth()->user()->jurusan_id > 0) {
            $data = $data->where('i.jurusan_id', '=', auth()->user()->jurusan_id);
        }

        $data = $data->select('i.*', 'j.nama as jurusan',  'sj.tanggal', 'sj.jam', 'sj.ruangan')
            ->orderBy('sj.tanggal', 'asc')
            ->orderBy('sj.ruangan', 'asc')
            ->orderBy('i.no_daftar', 'asc')
            ->get();
        
        
        $cdata = collect($data)->groupBy('tanggal')->all();
        $data = [];
        foreach ($cdata as $key => $value) {
            $cjam = collect($value)->groupBy('jam')->all();
            foreach ($cjam as $keyj => $valuej) {
                $cruangan = collect($valuej)->groupBy('ruangan')->all();
                foreach ($cruangan as $keyr => $valuer) {
                    array_push($data, [
                        'tanggal'=> $key,
                        'jam' => $keyj,
                        'ruangan' => $keyr,
                        'data' => $valuer,
                    ]);
                }
            }
        }
        return $data;
    }
    private function getDataHasil(){
        $data = DB::table('d_pendaftaran as i')
        
            ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
            ->join('d_seleksi_jadwal as sj','sj.pendaftaran_id','=', 'i.id')
            ->join('d_seleksi_hasil as sh','sh.pendaftaran_id','=', 'i.id')
            ->join('m_jurusan as j', 'j.id', '=', 'sh.jurusan_id');
        
        if (auth()->user()->jurusan_id > 0) {
            $data = $data->where('i.jurusan_id', '=', auth()->user()->jurusan_id);
        }

        $data = $data->leftJoin('m_status as ms', 'ms.id', '=', 'sh.status')
            ->select('i.*', 'j.nama as jurusan',  'sj.tanggal', 'sj.jam', 'sj.ruangan', 'sh.nilai', 'ms.nama as status')
            ->orderBy('sj.tanggal', 'asc')
            ->orderBy('sj.ruangan', 'asc')
            ->orderBy('i.no_daftar', 'asc')
            ->get();
        
        
        $cdata = collect($data)->groupBy('tanggal')->all();
        $data = [];
        foreach ($cdata as $key => $value) {
            $cjam = collect($value)->groupBy('jam')->all();
            foreach ($cjam as $keyj => $valuej) {
                $cruangan = collect($valuej)->groupBy('ruangan')->all();
                foreach ($cruangan as $keyr => $valuer) {
                    array_push($data, [
                        'tanggal'=> $key,
                        'jam' => $keyj,
                        'ruangan' => $keyr,
                        'data' => $valuer,
                    ]);
                }
            }
        }
        return $data;
    }
}
