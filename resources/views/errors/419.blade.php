@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card border-0 rounded-4 shadow-sm text-center p-5" style="max-width: 600px; background: linear-gradient(135deg, #ffffff 0%, #f8fafd 100%);">
        <div class="mb-4">
            <i class="bi bi-clock-history text-warning" style="font-size: 5rem;"></i>
        </div>
        <h1 class="display-4 fw-bold text-dark mb-3">Oops! Sesi Berakhir</h1>
        <h4 class="text-secondary mb-4">Kode Error: 419 (Page Expired)</h4>
        
        <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.6;">
            Halaman ini telah kedaluwarsa karena tidak ada aktivitas dari Anda dalam waktu yang lama. Ini merupakan bagian dari sistem keamanan kami untuk melindungi data Anda.
        </p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login Kembali
            </a>
        </div>
    </div>
</div>
@endsection
