<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;

class Dashboard extends Component
{
    public $tahun;
    public $tahunList = [];

    public $stats = [
        'total' => 0,
        'paid' => 0,
        'complete' => 0,
        'verified' => 0
    ];
    public $recentActivity = [];

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
        $this->calculateStats();
        $this->fetchRecentActivity();

        $prodi = Jurusan::query();
        if (auth()->user()->jurusan_id > 0) {
            $prodi = $prodi->where('id', auth()->user()->jurusan_id);
        }
        $prodi = $prodi->get();

        $columnChartModel = 
        (new ColumnChartModel())
            ->withDataLabels()
            ->setAnimated(true)
            ->setOpacity(0.85)
            ->withGrid()
            ->setColumnWidth(45);
            
        foreach ($prodi as $key => $value) {
            $pendaftarQuery = DB::table('d_pendaftaran')->where('jurusan_id', '=', $value->id);
            if ($this->tahun && $this->tahun != 'Semua') {
                $pendaftarQuery->whereYear('waktu', $this->tahun);
            }
            $columnChartModel->addColumn($value->nama, $pendaftarQuery->count(), $this->getColor($value->id));
        }
        $columnChartModel2 = 
        (new ColumnChartModel())
            ->withDataLabels()
            ->setAnimated(true)
            ->setOpacity(0.85)
            ->withGrid()
            ->setColumnWidth(45);
            
        foreach ($prodi as $key => $value) {
            $daftarUlangQuery = DB::table('d_pendaftaran as p')->join('d_daftar_ulang as du', 'du.pendaftaran_id','=','p.id')->where('du.jurusan_id', '=', $value->id);
            if ($this->tahun && $this->tahun != 'Semua') {
                $daftarUlangQuery->whereYear('p.waktu', $this->tahun);
            }
            $columnChartModel2->addColumn($value->nama, $daftarUlangQuery->count(), $this->getColor($value->id));
        }

        return view('livewire.dashboard', [
            'columnChartModel' => $columnChartModel, 
            'columnChartModel2' => $columnChartModel2,
            'title1'=>'Pendaftar Berdasarkan Prodi',
            'title2'=>'Daftar Ulang Berdasarkan Prodi'
        ])
        ->extends('layouts.app')
        ->section('content');
    }

    private function calculateStats()
    {
        $baseQuery = DB::table('d_pendaftaran');
        
        if (auth()->user()->jurusan_id > 0) {
            $baseQuery->where('jurusan_id', auth()->user()->jurusan_id);
        }

        if ($this->tahun && $this->tahun != 'Semua') {
            $baseQuery->whereYear('waktu', $this->tahun);
        }

        $this->stats['total'] = (clone $baseQuery)->count();
        $this->stats['paid'] = (clone $baseQuery)->where('status_bayar', '>', 0)->count();
        $this->stats['complete'] = (clone $baseQuery)
            ->whereNotNull('photo_image')
            ->where('photo_image', '!=', '')
            ->whereNotNull('ijazah_image')
            ->where('ijazah_image', '!=', '')
            ->count();
        $this->stats['verified'] = (clone $baseQuery)->where('status_lulus', 1)->count();
    }

    private function fetchRecentActivity()
    {
        $query = DB::table('d_pendaftaran as p')
            ->leftJoin('m_jurusan as j', 'j.id', '=', 'p.jurusan_id')
            ->select('p.id', 'p.no_daftar', 'p.nama_depan', 'p.nama_belakang', 'p.waktu', 'j.nama as prodi', 'p.status_bayar')
            ->orderBy('p.waktu', 'desc')
            ->limit(5);

        if (auth()->user()->jurusan_id > 0) {
            $query->where('p.jurusan_id', auth()->user()->jurusan_id);
        }

        $this->recentActivity = $query->get();
    }

    private function getColor($id){
        $jur = Jurusan::find($id);
        return $jur ? $jur->color : '#000000';
    }
    private function randColor(){
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        return $color;
    }
}
