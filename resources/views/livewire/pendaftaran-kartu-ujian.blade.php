<div class="container container-fluid" style="overflow-x: auto">
    <div class="d-print-grid border p-3 shadow" style="width: 210mm;">
        {{-- <span class="float-end">
            {!! QrCode::size(50)->generate($data['qrcode']) !!}
        </span>
        <div class="row">
            <div class="col  border-bottom">
                <h5 class="text-center mb-0">KARTU PESERTA UJIAN</h5>
                <h5 class="text-center mb-0">SELEKSI MANDIRI MAHASISWA BARU</h5>
                <h6 class="text-center">TAHUN AKADEMIK {{$data['ta']}}</h6>
            </div>
        </div> --}}
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-sm" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="4">
                                <img class="mt-3 mb-3" src="{{url('/logo')}}" style="width: 120px;" alt="StikesPIK">
                                <h4 class="text-center mb-0">KARTU PESERTA UJIAN</h4>
                                <h4 class="text-center mb-0">SELEKSI MANDIRI MAHASISWA BARU</h4>
                                <h6 class="text-center">TAHUN AKADEMIK {{$data['ta']}}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="6" class="text-center">
                                <figure class="figure border p-1 mb-0" >
                                    {{-- <figcaption class="figure-caption text-center"><h6 class="mb-0"><strong>{{$data['no_daftar']}}</strong></h6></figcaption> --}}
                                    <img src="{{$data['photo_image'] ? url('/photo/'.$data['photo_image']) : url('/assets/blank_photo.jpg')}}" 
                                    style="!important; width: 200px"
                                    class="figure-img img-thumbnail img-fluid border-0 mb-0" alt="{{$data['photo_image']}}">
                                </figure>
                            </td>
                            <td class="p-1"style="vertical-align: middle;">Nomor Peserta</td>
                            <td class="text-center p-1" style="width: 5px;">:</td>
                            <td class="p-1" style="vertical-align: middle;"><strong>{{$data['no_daftar']}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">Nama Lengkap</td>
                            <td >:</td>
                            <td class="p-1" style="vertical-align: middle;"><strong>{{$data['nama_depan']}} {{$data['nama_belakang']}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">Asal Sekolah</td>
                            <td>:</td>
                            <td class="p-1" style="vertical-align: middle;"><strong>{{$data['asal_sekolah_npsn']}} - {{$data['asal_sekolah']}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">NIK</td>
                            <td>:</td>
                            <td class="p-1" style="vertical-align: middle;"><strong>{{$data['nik']}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td class="p-1" style="vertical-align: middle;"><strong>{{$data['tempat_lahir']}}, {{\Carbon\Carbon::parse($data['tanggal_lahir'])->isoFormat('d MMMM Y')}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">Jenis Kelamin</td>
                            <td>:</td>
                            <td class="p-1" style="vertical-align: middle;"><strong>{{$data['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">Tanggal Ujian</td>
                            <td class="p-1" style="vertical-align: middle;" colspan="4"><strong>{{\Carbon\Carbon::parse($data['tanggal_ujian'])->isoFormat('d MMMM Y')}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">Lokasi Ujian</td>
                            <td class="p-1" colspan="4"><strong>{{$data['ruangan']}}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-1" style="vertical-align: middle;">PIN Ujian</td>
                            <td class="p-1" colspan="4"><strong></strong></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <p class="mb-0"><strong>PERHATIAN:</strong></p>
                                <ol style="list-style-position: outside; ">
                                    <li  style="list-style-position: outside;">Kartu Peserta Ujian ini wajib dibawa saat pelaksanaan Ujian.</li>
                                    <li style="list-style-position: outside;">Peserta wajib membawa Kartu/Bukti Identitas Diri (Asli) yang tercantum pada kartu ini dan terdapat di dalam system pada saat ujian.</li>
                                    <li style="list-style-position: outside;">Peserta wajib menggunakan masker 3 lapis (3 ply) ditambah masker kain di bagian luar (double masker) dan mengikuti protokol kesehatan berada di lokasi ujian.</li>
                                    <li style="list-style-position: outside;">Peserta wajib mematuhi peraturan yang berlaku pada saat pelaksanaan ujian.</li>
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col">
                <dl class="row">
                    <dd class="col-3 mb-0">Nama Lengkap</dd>
                    <dt class="col-9 mb-0">{{$data['nama_depan']}} {{$data['nama_belakang']}}</dt>
                    <dd class="col-3 mb-0">Jenis Kelamin</dd>
                    <dt class="col-9 mb-0">{{$data['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</dt>
                    <dd class="col-3 mb-0">Tpt/Tgl Lahir</dd>
                    <dt class="col-9 mb-0">{{$data['tempat_lahir']}}, {{\Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y')}}</dt>
                    <dd class="col-3 mb-0">Asal Sekolah</dd>
                    <dt class="col-9 mb-0">{{$data['asal_sekolah']}}</dt>

                    <dt class="col-12 text-primary  mb-2  border-bottom">PILIHAN JURUSAN</dt>
                    <dd class="col-3 mb-0">Jurusan</dd>
                    <dt class="col-9 mb-0">{{$data['jurusan']}}</dt>
                    <dd class="col-3 mb-0">No. Daftar</dd>
                    <dt class="col-9 mb-0">{{$data['no_daftar']}}</dt>
                    <dt class="col-12 text-primary  mb-2  border-bottom">JADWAL SELEKSI</dt>
                    <dd class="col-3 mb-0">Waktu</dd>
                    <dt class="col-9 mb-0">{{\Carbon\Carbon::parse($data['tanggal_ujian'])->format('d M Y')}} Jam: {{\Carbon\Carbon::parse($data['jam_ujian'])->format('H:i')}}</dt>
                    <dd class="col-3 mb-0">Ruangan</dd>
                    <dt class="col-9 mb-0">{{$data['ruangan']}}</dt>
                    
                </dl>
                
            </div>
            <div class="col-auto">
                <div class="text-center">
                <figure class="figure float-end border p-1 mb-0" >
                    <img src="{{$data['photo_image'] ? url('/photo/'.$data['photo_image']) : url('/assets/blank_photo.jpg')}}" 
                    style="height: 260px !important; width: 200px"
                    class="figure-img img-thumbnail img-fluid border-0 mb-0" alt="{{$data['photo_image']}}">
                </figure>
                
                </div>
            </div>
        </div> --}}
        <hr class="mb-1">
        @livewire('kontak-person')
    </div>

</div>