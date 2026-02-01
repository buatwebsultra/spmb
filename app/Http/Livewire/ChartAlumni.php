<?php

namespace App\Http\Livewire;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\Component;

class ChartAlumni extends Component
{

    public function render()
    {
        $columnChartModel = 
        (new ColumnChartModel())
            ->setTitle('Expenses by Type')
            ->addColumn('Food', 100, '#f6ad55')
            ->addColumn('Shopping', 200, '#fc8181')
            ->addColumn('Travel', 300, '#90cdf4');
            
            return view('livewire.chart-alumni')->with([
                'columnChartModel' => $columnChartModel,
            ]);
    }
}
