<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Facades\URL;

class Breadcrumb extends Component
{
    public $urls;

    public function render()
    {
        
        $route = Route::currentRouteName();
        $url = URL::full();
        $purl = parse_url($url);
        $query = $purl ? (isset($purl['query']) ? $purl['query']:'') : '';
        $arr = explode('.', $route);
        $url = [];
        $vb = '';
        $rn = '';
        $host = env('APP_URL');
        $numItems = count($arr);
        $i = 0;
        foreach ($arr as $key => $value) {

            $vb = $vb.($vb!=''?'/':'').$value;
            $rn = $rn.($rn!=''?'.':'').$value; 

            array_push($url, [
                // 'route' => $value=='show'? $host.'/info' : $host.'/'.$vb,
                'route' => $host.'/'.$vb.((++$i === $numItems) ? '?'.$query:''),
                'name' => $rn,
                'label' => strtoupper($value),
            ]);
        }
        $this->urls = $url;
        return view('livewire.breadcrumb');
    }
}
