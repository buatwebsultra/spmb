@extends('layouts.print')

@section('content')
    @if($cetak==1)
        @include('pdf.form-pendaftaran')
    @elseif($cetak==2)
        @include('pdf.invoice-daftar')
    @elseif ($cetak==3)
        @include('pdf.kartu-ujian')
    @elseif ($cetak==4)
        @include('pdf.invoice-spp')
    @elseif ($cetak==5)
        @include('pdf.jadwal-peserta')
    @elseif ($cetak==6)
        @include('pdf.pengumuman-hasil')
    @elseif ($cetak==7)
        @include('pdf.pengumuman')
    @endif
@endsection