<div class="container">
    @if(auth()->user()->level_id==4)
        @livewire('my-pendaftaran')
    @else
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
