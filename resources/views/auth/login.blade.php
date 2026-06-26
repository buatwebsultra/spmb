@extends('layouts.app')

@section('content')
<div class="container">
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  shadow border-primary">
                <div class="card-header bg-primary text-light">{{ __('Masuk Akun Pendaftaran') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ingat Saya') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary text-light">
                                    {{ __('Masuk') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-outline-primary" href="{{ route('password.request') }}">
                                        Lupa Password Akun ?
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="btn btn-outline-primary" href="{{ route('register') }}">
                                        Belum Pernah Mendaftar ?
                                    </a>
                            @endif
                            </div>
                        </div>
                    </form>
                    {{-- <hr> --}}
                    {{-- <div class="row">
                        <div class="col text-center">
                            @if (Route::has('register'))
                                    <a class="btn btn-outline-primary" href="{{ route('register') }}">
                                        Belum Pernah Mendaftar ?
                                    </a>
                            @endif
                        </div>
                    </div> --}}
                </div>
            </div>
    </div>
    
    @if (session()->has('register_success_modal'))
        <!-- Modal Sukses Registrasi -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-success text-white border-0 py-3">
                        <h5 class="modal-title d-flex align-items-center fw-bold" id="successModalLabel">
                            <i class="bi bi-check-circle-fill me-2 fs-4"></i> Registrasi Berhasil!
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <div class="mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center bg-light text-success rounded-circle" style="width: 80px; height: 80px;">
                                <i class="bi bi-person-check fs-1"></i>
                            </span>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Halo, {{ session('register_success_modal')['name'] }}!</h4>
                        <p class="text-muted fs-6">
                            Akun pendaftaran Anda dengan email <strong class="text-primary">{{ session('register_success_modal')['email'] }}</strong> telah berhasil terdaftar dalam sistem.
                        </p>
                        <hr class="my-3 opacity-25">
                        <div class="alert alert-info border-0 text-start py-2 px-3 mb-0" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle-fill me-1"></i> Silakan masuk menggunakan Email dan Password yang telah Anda daftarkan tadi untuk melanjutkan pengisian form pendaftaran.
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light justify-content-center">
                        <button type="button" class="btn btn-success px-4 text-light fw-bold" data-bs-dismiss="modal">
                            Mulai Mengisi Form
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        </script>
        @endpush
    @endif
</div>
@endsection
