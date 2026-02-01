<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pembayaran extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query;
    public $listjurusan = [];
    public $perpage = 5;
    public $waktu_awal, $waktu_akhir, $periode, $jurusan_id;
    public $status_bayar_pendaftaran='', $status_bayar_spp='';


    public function mount(){
        $this->waktu_awal = \Carbon\Carbon::now()->format('Y-m-d');
        $this->waktu_akhir = \Carbon\Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $this->listjurusan = DB::table('m_jurusan')->get();
        return view('livewire.pembayaran', [
            'data' => $this->getData(),
        ])
        ->extends('layouts.app')
        ->section('content');
    }
    private function getData(){
        $cari = $this->query;
        $data = DB::table('d_pendaftaran as i')
            ->join('m_jurusan as p', 'p.id', '=', 'i.jurusan_id')
            ->leftJoin('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
            ->leftJoin('d_bayar_spp as bs', 'bs.pendaftaran_id', '=', 'i.id')
            ->select('i.*', 'bp.jumlah as bayar_pendaftaran', 'bp.waktu as waktu_bayar_pendaftaran',
                'bs.jumlah as bayar_spp', 'bs.waktu as waktu_bayar_spp',
                    'p.nama as jurusan'
            );
        if($cari!=''){
            $data = $data->where(function($q)use($cari){
                $q->orWhere('i.nama_depan', 'like', '%'.$cari.'%');
                $q->orWhere('i.nama_belakang', 'like', '%'.$cari.'%');
                $q->orWhere('i.no_daftar', 'like', $cari.'%');
            });
        }
        if($this->jurusan_id>0){
            $data = $data->where('i.jurusan_id', '=', $this->jurusan_id);
        }
        if($this->status_bayar_pendaftaran!=''){
            $data = $data->whereRaw('i.status_bayar '.($this->status_bayar_pendaftaran==1 ? ' > 0 ' : ' is null '));
        }
        if($this->status_bayar_spp!=''){
            $data = $data->whereRaw('i.status_spp '.($this->status_bayar_spp==1 ? ' > 0 ' : ' is null '));
        }
        $data = $data->paginate($this->perpage);
        return $data;
    }
}
