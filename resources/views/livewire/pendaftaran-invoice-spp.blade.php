<div class="container container-fluid" style="overflow-x: auto">
    <div class="d-print-grid border p-3 shadow" style="width: 210mm; background-image: url({{$data['bgspp']}}); background-repeat: no-repeat; background-size: container; background-position: center;">

        <div class="row border-bottom d-flex align-items-center pb-2 mb-2">
            <div class="col-2">
                <span class="float-start">
                    <img src="{{url('/logo')}}" style="width: 80px;" alt="StikesPIK">
                </span>
            </div>
            <div class="col">
                <h5 class="text-center">SETORAN BIAYA MASUK MAHASISWA BARU</h1>
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
                    <dd class="col-4 mb-0">NIM</dd>
                    <dt class="col-8 mb-0">{{$data['nim']}}</dt>
                    <dd class="col-4 mb-0">Jurusan</dd>
                    <dt class="col-8 mb-0">{{$data['jurusan_lulus']}}</dt>
                    <dd class="col-4 mb-0">Jumlah Setoran</dd>
                    <dt class="col-8 mb-0">Rp. {{$invoice['biaya_jumlah']}},-</dt>
                    <dd class="col-4 mb-0">Rincian:</dd>
                    <dt class="col-8 mb-0"></dt>
                    <dd class="col-12 mb-0">
                        <dl class="row ms-2">
                            <dd class="col-sm-8 mb-0">SPP</dd>
                            <dt class="col-sm-4 mb-0 text-end">Rp. {{ $data['status_spp']>0 ? number_format($data['biaya_spp'], 0, ',', '.') : $invoice['biaya_spp']}}</dt>
                            <dd class="col-sm-8 mb-0">Dana Peningkatan Pendidikan</dd>
                            <dt class="col-sm-4 mb-0  text-end">Rp. {{ $data['status_spp']>0 ? number_format($data['biaya_pendidikan'], 0, ',', '.') : $invoice['biaya_pendidikan']}}</dt>
                            <dd class="col-sm-8 mb-0">Dana Almamater</dd>
                            <dt class="col-sm-4 mb-0  text-end">Rp. {{ $data['status_spp']>0 ? number_format($data['biaya_almamater'], 0, ',', '.') : $invoice['biaya_almamater']}}</dt>
                            <dd class="col-sm-8 mb-0">Dana Lain</dd>
                            <dt class="col-sm-4 mb-0  text-end">Rp. {{ $data['status_spp']>0 ? number_format($data['biaya_lain'], 0, ',', '.') : $invoice['biaya_lain']}}</dt>
                            <dd class="col-sm-8 mb-0 border-top border-2"><strong>Jumlah</strong></dd>
                            <dt class="col-sm-4 mb-0  text-end border-top"><strong>Rp. {{ $data['status_spp']>0 ? number_format(($data['biaya_jumlah']) , 0, ',', '.') : $invoice['biaya_jumlah']}}</strong></dt>
                        </dl>
                    </dd>
                </dl>
            </div>
            <div class="col">
                <dl class="row">
                    <dd class="col-4 mb-0">Nama Bank</dd>
                    <dt class="col-8 mb-0">{{$invoice['nama_bank']}}</dt>
                    <dd class="col-4 mb-0">No. Rekening</dd>
                    <dt class="col-8 mb-0">{{$invoice['nomor_rekening']}}</dt>
                    <dd class="col-4 mb-0">Nama Rekening</dd>
                    <dt class="col-8 mb-0">{{$invoice['nama_rekening']}}</dt>
                    <dd class="col-2 mb-0">Terbilang</dd>
                    <dt class="col-10 mb-0">#{{$invoice['terbilang_jumlah']}}#</dt>
                    <dd class="col-2 mb-0">Berita</dd>
                    <dt class="col-10 mb-0">SPP1-{{$data['nim']}}</dt>
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

        @if($data['status_spp']>0)
            <h6 class="text-success">Tanggal Bayar: {{\Carbon\Carbon::parse($data['waktu_bayar_spp'])->isoFormat('dddd, D MMMM YYYY HH:mm')}}</h6>
        @endif
        <hr class="mb-1">
        @livewire('kontak-person')
    </div>

</div>