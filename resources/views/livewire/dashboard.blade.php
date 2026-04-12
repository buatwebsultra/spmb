<div class="container-fluid px-4">
    @if(auth()->user()->level_id==4)
        @livewire('my-pendaftaran')
    @else
    
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);">
                <div class="card-body p-4 p-md-5 text-white position-relative">
                    <div class="position-relative z-index-10">
                        <h2 class="fw-bold mb-1">Selamat Datang Kembali, {{ auth()->user()->name }}!</h2>
                        <p class="lead opacity-75 mb-0">Pantau perkembangan pendaftaran mahasiswa baru hari ini: {{ date('d M Y') }}</p>
                    </div>
                    <i class="bi bi-rocket-takeoff position-absolute end-0 bottom-0 opacity-10" style="font-size: 10rem; margin-right: -2rem; margin-bottom: -2rem;"></i>
                    
                    <div class="position-absolute top-0 end-0 p-4">
                        <select class="form-select form-select-sm bg-white bg-opacity-10 text-white border-white border-opacity-25 rounded-pill px-3" wire:model="tahun" style="width: 150px;">
                            <option value="Semua" class="text-dark">Semua Tahun</option>
                            @foreach($tahunList as $thn)
                            <option value="{{$thn}}" class="text-dark">Tahun {{$thn}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-people-fill text-primary fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold mb-1">Total Pendaftar</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats['total']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-cash-stack text-success fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold mb-1">Lunas Bayar</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats['paid']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-file-earmark-check text-warning fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold mb-1">Berkas Lengkap</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats['complete']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-shield-check text-info fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold mb-1">Terverifikasi</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats['verified']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Analytics & Activity Section -->
    <div class="row g-4 mb-4">
        <!-- Chart 1 -->
        <div class="col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0"><i class="bi bi-grid-fill text-primary me-2"></i> {{$title1}}</h5>
                        <span class="badge bg-light text-dark rounded-pill px-3">{{ $tahun == 'Semua' ? 'Keseluruhan' : 'Tahun '.$tahun }}</span>
                    </div>
                    <div style="height: 25rem;">
                        <livewire:livewire-column-chart key="{{ 'chart-pendaftar-'.$tahun }}" :column-chart-model="$columnChartModel"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-activity text-danger me-2"></i> Pendaftar Terbaru</h5>
                    <div class="activity-feed">
                        @forelse($recentActivity as $act)
                        <div class="d-flex align-items-center mb-4 pb-4 border-bottom last-child-no-border">
                            <div class="avatar-circle me-3">
                                {{ strtoupper(substr($act->nama_depan, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">{{ $act->nama_depan }} {{ $act->nama_belakang }}</h6>
                                <p class="text-muted small mb-0">{{ $act->prodi }} • {{ \Carbon\Carbon::parse($act->waktu)->diffForHumans() }}</p>
                            </div>
                            <div class="ms-2">
                                @if($act->status_bayar > 0)
                                    <span class="badge bg-success-soft text-success rounded-pill px-2">Paid</span>
                                @else
                                    <span class="badge bg-danger-soft text-danger rounded-pill px-2">Unpaid</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Belum ada aktivitas terbaru</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart 2 -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0"><i class="bi bi-check-circle-fill text-success me-2"></i> {{$title2}}</h5>
                        <span class="badge bg-light text-dark rounded-pill px-3">{{ $tahun == 'Semua' ? 'Keseluruhan' : 'Tahun '.$tahun }}</span>
                    </div>
                    <div style="height: 25rem;">
                        <livewire:livewire-column-chart key="{{ 'chart-daftarulang-'.$tahun }}" :column-chart-model="$columnChartModel2"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .transition-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1) !important;
        }
        .avatar-circle {
            width: 45px;
            height: 45px;
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
        .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
        .last-child-no-border:last-child {
            border-bottom: 0 !important;
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }
    </style>
</div>
