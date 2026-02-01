<div class="border p-3" style="width: 210mm;  background-color: white"> 
    
        <div class="row border-bottom d-flex align-items-center pb-2 mb-2">
            <div class="col-2">
                <span class="float-start">
                    <img src="{{url('/logo')}}" style="width: 80px;" alt="StikesPIK">
                </span>
            </div>
            <div class="col">
                <h5 class="text-center">SETORAN PENDAFTARAN MAHASISWA BARU</h1>
                <h6 class="text-center">TAHUN AKADEMIK {{$data['ta']}}</h5>
                
            </div>
            <div class="col-2">
                <span class="float-end">
                    {!! QrCode::size(50)->generate($data['qrcode']) !!}
                </span>
            </div>
        </div>
    <div class="row">
        <div class="col">
            <dl class="row">
                <dd class="col-4 mb-0">Nama Lengkap</dd>
                <dt class="col-8 mb-0">{{$data['nama_depan']}} {{$data['nama_belakang']}}</dt>
                <dd class="col-4 mb-0">Jenis Kelamin</dd>
                <dt class="col-8 mb-0">{{$data['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</dt>
                <dd class="col-4 mb-0">Jumlah Setoran</dd>
                <dt class="col-8 mb-0">Rp. {{$invoice['biaya_pendaftaran']}},-</dt>
            </dl>
            
        </div>
        <div class="col">
            <dl class="row">
                <dd class="col-4 mb-0">No. Daftar</dd>
                <dt class="col-8 mb-0">{{$data['no_daftar']}}</dt>
                <dd class="col-4 mb-0">Tanggal Daftar</dd>
                <dt class="col-8 mb-0">{{\Carbon\Carbon::parse($data['waktu'])->format('d M Y')}}</dt>
                <dd class="col-4 mb-0">Pilihan Jurusan</dd>
                <dt class="col-8 mb-0">{{$data['jurusan']}}</dt>
                
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <dl class="row">
                <dd class="col-4 mb-0">Terbilang</dd>
                <dt class="col-8 mb-0">#{{$invoice['terbilang']}}#</dt>
                <dd class="col-4 mb-0">Berita</dd>
                <dt class="col-8 mb-0">MABA-{{$data['no_daftar']}}</dt>
            </dl>
            {{-- <p class="mb-1">Terbilang: <strong>#{{$invoice['terbilang']}}#</strong></p>
            <p class="mb-1">Berita: <strong>MABA-{{$data['no_daftar']}}</strong></p> --}}
        </div>
        <div class="col">
            <dl class="row">
                <dd class="col-4 mb-0">Nama Bank</dd>
                <dt class="col-8 mb-0">{{$invoice['nama_bank']}}</dt>
                <dd class="col-4 mb-0">No. Rekening</dd>
                <dt class="col-8 mb-0">{{$invoice['nomor_rekening']}}</dt>
                <dd class="col-4 mb-0">Nama Rekening</dd>
                <dt class="col-8 mb-0">{{$invoice['nama_rekening']}}</dt>
            </dl>
        </div> 
    </div>
    <div class="row">
        <div class="col-6  p-4">
            <div class="border-bottom border-3 text-center d-flex align-items-end" style="height: 50px" >
            </div>
            <p class="mb-0 text-center">Tanda Tangan Teller</p>
        </div>
        <div class="col-6  p-4">
            <div class="border-bottom border-3 text-center d-flex align-items-end" style="height: 50px" >
            </div>
            <p class="mb-0 text-center">Tanda Tangan Penyetor</p>
        </div>
    </div>
    @if($data['status_bayar']>0)
        <h6 class="text-success">Tanggal Bayar: {{\Carbon\Carbon::parse($data['waktu_bayar_pendaftaran'])->isoFormat('dddd, D MMMM YYYY HH:mm')}}</h6>
    @endif
    <hr class="mb-1">
    @livewire('kontak-person')
</div>