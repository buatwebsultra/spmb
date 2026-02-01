<div class="p-2 bg-white" style="width: 210mm !important; height: auto;  background-color: white">
    <table class="table table-bordered" style="width: 90%" border="1">
        <tbody>
            <tr>
                <td class="text-center"  style="vertical-align: middle">
                    <img src="{{url('/logo')}}" style="width: 80px;" alt="StikesPIK">
                </td>
                <td colspan="4" style="vertical-align: middle">
                    <h2 class="text-center">{{$instansi}}</h2>
                    <h4 class="text-center">PENGUMUMAN HASIL SELEKSI MANDIRI {{$ta}}</h4>
                </td>
                <td class="text-center"  style="vertical-align: middle">
                    {!! QrCode::size(50)->generate($data['qrcode']) !!}
                    <img src="data:image/svg+xml;base64,  {!! base64_encode(QrCode::size(50)->generate($data['qrcode'])) !!} ">
                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> --}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="4">
                    <img src="{{$data['photo_image'] ? url('/photo/'.$data['photo_image']) : url('/assets/blank_photo.jpg')}}" 
                    class="img-thumbnail" style="max-height: 10rem;" alt="{{$data['photo_image']}}">
                </td>
                <td style="width: 120px">Nama Peserta</td>
                <td colspan="3">: <strong>{{$data['nama_depan']}} {{$data['nama_belakang']}}</strong></td>
            </tr>
                <td style="width: 120px">Nomor Peserta</td>
                <td colspan="3">: <strong>{{$data['no_daftar']}}</strong></td>
            <tr>
                <td style="width: 120px">Tanggal Lahir</td>
                <td colspan="3">: <strong>{{\Carbon\Carbon::parse($data['tanggal_lahir'])->isoFormat('DD MMMM YYYY')}}</strong></td>
            </tr>
            @if($data['status']==1)
            <tr>
                <td colspan="4">
                    <h5 class="text-success">Selamat Anda dinyatakan LULUS seleksi mandiri {{$ta}} di<h5>
                    <h4 class="text-primary">Program Studi :  {{$data['jurusan']}}</h4>
                    <p>Informasi persyaratan pendaftaran ulang calon mahasiswa baru dapat dilihat di: <strong class="text-primary"> {{$link_syarat_daftar_ulang}} </strong></p>
                </td>
            </tr>
            @else
            <tr>
                <td colspan="4">
                    <h4 class="text-danger">Maaf, Anda dinyatakan TIDAK LULUS seleksi mandiri {{$ta}}</h4>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    <hr>
    @livewire('kontak-person')
    {{-- <div class="card border border-{{($data['status_lulus']>0) ? 'primary' : 'danger'}}">
        <div class="card-body">
            <div class="row border-bottom d-flex align-items-center pb-2 mb-2">
                <div class="col-2">
                    <span class="float-start">
                        <img src="{{url('/logo')}}" style="width: 80px;" alt="StikesPIK">
                    </span>
                </div>
                <div class="col">
                    <h2 class="text-center">{{$instansi}}</h2>
                    <h4 class="text-center">PENGUMUMAN HASIL SELEKSI MANDIRI {{$ta}}</h4>
                    
                </div>
                <div class="col-2">
                    <span class="float-end">
                        {!! QrCode::size(50)->generate($data['qrcode']) !!}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text-center">
                    <img src="{{$data['photo_image'] ? url('/photo/'.$data['photo_image']) : url('/assets/blank_photo.jpg')}}" 
                    class="img-thumbnail" style="max-height: 15rem;" alt="{{$data['photo_image']}}">
                </div>
                <div class="col">
                    <dl class="row my-2">
                        <dd class="col-3 mb-0">Nama Peserta</dd>
                        <dt class="col-9 mb-0">: {{$data['nama_depan']}} {{$data['nama_belakang']}}</dt>
                        <dd class="col-3 mb-0">Nomor Peserta</dd>
                        <dt class="col-9 mb-0">: {{$data['no_daftar']}}</dt>
                        <dd class="col-3 mb-0">Tanggal Lahir</dd>
                        <dt class="col-9 mb-2">: {{\Carbon\Carbon::parse($data['tanggal_lahir'])->isoFormat('DD MMMM YYYY')}}</dt>
                        @if($data['status']==1)
                        <dt class="col-12 mb-2">
                            <h4 class="text-success">Selamat Anda dinyatakan LULUS seleksi mandiri {{$ta}} di<h4>
                        </dt>
                        <dt class="col-12 mb-2 text-primary">
                            <h5>Program Studi :  {{$data['jurusan']}}</h5>
                        </dt>
                        <dt class="col-12 mb-2">
                            Informasi persyaratan pendaftaran ulang calon mahasiswa baru dapat dilihat di: <strong class="text-primary"> {{$link_syarat_daftar_ulang}} </strong>
                        </dt>
                        @else
                        <h4 class="text-danger">Maaf, Anda dinyatakan TIDAK LULUS seleksi mandiri {{$ta}}</h4>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div> --}}
</div>