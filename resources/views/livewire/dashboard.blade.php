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
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafd 100%);">
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4" style="color: #2c3e50; font-weight: 700;">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i> {{$title1}}
                    </h5>
                    <div class="w-100" style="height: 32rem;" >
                        <livewire:livewire-column-chart key="{{ 'chart-pendaftar-'.$tahun }}" :column-chart-model="$columnChartModel"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafd 100%);">
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4" style="color: #2c3e50; font-weight: 700;">
                        <i class="bi bi-pie-chart-fill text-success me-2"></i> {{$title2}}
                    </h5>
                    <div class="w-100" style="height: 32rem;">
                        <livewire:livewire-column-chart key="{{ 'chart-daftarulang-'.$tahun }}" :column-chart-model="$columnChartModel2"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
