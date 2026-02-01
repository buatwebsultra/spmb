@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-light">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            <p>Link Reset Password telah dikirimkan ke Email Anda, Silahkan periksa kembali</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} <p>Coba beberapa menit kembali</p></strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div id="spinner" class="spinner-border  text-primary" role="status" style="display: none">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <button id="btnsend" type="submit" class="btn btn-primary text-light">
                                    {{ __('Kirim Link Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script> 
    document.addEventListener("DOMContentLoaded", function(event) { 
        const btnsend = document.getElementById('btnsend');
        const spinner = document.getElementById('spinner');
        btnsend.addEventListener('click', ()=>{
            spinner.style.display = 'block';
            btnsend.style.display = 'none';
        });
    });
 </script>
@endpush