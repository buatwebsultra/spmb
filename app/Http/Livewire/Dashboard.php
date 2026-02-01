<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        $prodi = DB::table('m_jurusan')->get();
        $columnChartModel = 
        (new ColumnChartModel())->withDataLabels();//->setTitle('Pendaftar Berdasarkan Prodi');
        foreach ($prodi as $key => $value) {
            $columnChartModel->addColumn($value->nama, DB::table('d_pendaftaran')->where('jurusan_id', '=', $value->id)->count(), $this->getColor($value->id));
        }
        $columnChartModel2 = 
        (new ColumnChartModel())->withDataLabels();//->setTitle('Daftar Ulang Berdasarkan Prodi');
        foreach ($prodi as $key => $value) {
            $columnChartModel2->addColumn($value->nama, DB::table('d_pendaftaran as p')->join('d_daftar_ulang as du', 'du.pendaftaran_id','=','p.id')->where('du.jurusan_id', '=', $value->id)->count(), $this->getColor($value->id));
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
