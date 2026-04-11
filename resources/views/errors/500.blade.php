@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card border-0 rounded-4 shadow-sm text-center p-5" style="max-width: 600px; background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
        <div class="mb-4">
            <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 5rem;"></i>
        </div>
        <h1 class="display-4 fw-bold text-dark mb-3">Oops! Terjadi Kesalahan</h1>
        <h4 class="text-secondary mb-4">Kode Error: 500 (Server Error)</h4>
        
        <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.6;">
            Maaf, sistem sedang mengalami gangguan teknis sementara saat memproses permintaan Anda. Hal ini bisa disebabkan oleh format isian yang tidak sesuai atau koneksi database yang terputus. Mohon periksa kembali isian form Anda atau coba sesaat lagi.
        </p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="javascript:history.back()" onclick="window.location.reload();" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang Halaman
            </a>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-house me-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
