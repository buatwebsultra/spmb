@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-light">{{ __('Verifikasi Email Anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link Verifikasi telah dikirimkan ke Email Anda, Silahkan periksa kembali') }}
                        </div>
                    @endif
                        <p>Sebelum proses selanjutnya silahkan periksa Email Anda untuk melakukan verifikasi.
                        Jika belum menerima Email Verifikasi, </p>
                   
                    <form  class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button id="btnsend"  type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik disini untuk kirim lagi') }}</button>.
                    </form>
                    <div id="spinner" class="spinner-border  text-primary" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
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