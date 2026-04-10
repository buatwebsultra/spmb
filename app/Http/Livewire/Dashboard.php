<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $tahun;
    public $tahunList = [];

    public function mount()
    {
        $this->tahun = \Carbon\Carbon::now()->format('Y');
        
        $years = DB::table('d_pendaftaran')
            ->selectRaw('YEAR(waktu) as tahun')
            ->whereNotNull('waktu')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();
        
        if (!in_array((int)$this->tahun, $years)) {
            array_unshift($years, (int)$this->tahun);
        }
        $this->tahunList = $years;
    }

    public function render()
    {
        $prodi = DB::table('m_jurusan');
        if (auth()->user()->jurusan_id > 0) {
            $prodi = $prodi->where('id', auth()->user()->jurusan_id);
        }
        $prodi = $prodi->get();

        $columnChartModel = 
        (new ColumnChartModel())->withDataLabels();//->setTitle('Pendaftar Berdasarkan Prodi');
        foreach ($prodi as $key => $value) {
            $pendaftarQuery = DB::table('d_pendaftaran')->where('jurusan_id', '=', $value->id);
            if ($this->tahun && $this->tahun != 'Semua') {
                $pendaftarQuery->whereYear('waktu', $this->tahun);
            }
            $columnChartModel->addColumn($value->nama, $pendaftarQuery->count(), $this->getColor($value->id));
        }
        $columnChartModel2 = 
        (new ColumnChartModel())->withDataLabels();//->setTitle('Daftar Ulang Berdasarkan Prodi');
        foreach ($prodi as $key => $value) {
            $daftarUlangQuery = DB::table('d_pendaftaran as p')->join('d_daftar_ulang as du', 'du.pendaftaran_id','=','p.id')->where('du.jurusan_id', '=', $value->id);
            if ($this->tahun && $this->tahun != 'Semua') {
                $daftarUlangQuery->whereYear('p.waktu', $this->tahun);
            }
            $columnChartModel2->addColumn($value->nama, $daftarUlangQuery->count(), $this->getColor($value->id));
        }

        return view('livewire.dashboard', ['columnChartModel' => $columnChartModel, 'columnChartModel2' => $columnChartModel2,
             'title1'=>'Pendaftar Berdasarkan Prodi',
             'title2'=>'Daftar Ulang Berdasarkan Prodi'])
        ->extends('layouts.app')
        ->section('content');
    }
    private function getColor($id){
        return (DB::table('m_jurusan')->where('id', '=', $id)->first())->color;
    }
    private function randColor(){
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        return $color;
    }
}
