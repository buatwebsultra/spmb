<div class="container">
    @if(auth()->user()->level_id==4)
        @livewire('my-pendaftaran')
    @else
    <div class="row mb-2 justify-content-end">
        <div class="col-md-3">
            <select class="form-select" wire:model="tahun">
                <option value="Semua">Semua Tahun</option>
                @foreach($tahunList as $thn)
                <option value="{{$thn}}">{{$thn}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-4 border bg-white shadow">
        <div class="col">
            <h6 class="text-center mt-2"><strong>{{$title1}}</strong></h6>
            <div class="p-2 bg-white " style="height: 36rem;" >
                <livewire:livewire-column-chart :column-chart-model="$columnChartModel"/>
            </div>
        </div>
    </div>
    <br>
    <div class="row mb-4 bg-white border shadow">
        <div class="col">
            <h6 class="text-center  mt-2"><strong>{{$title2}}</strong></h6>
            <div class="p-2 bg-white" style="height: 36rem;">
                
                <livewire:livewire-column-chart :column-chart-model="$columnChartModel2"/>
            </div>
        </div>
    </div>
    @endif
</div>
