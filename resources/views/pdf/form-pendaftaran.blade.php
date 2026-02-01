<div class="p-2 bg-white" style="width: 210mm; height: auto;  background-color: white">
    <h3 class="text-center">PENDAFTARAN MAHASISWA BARU</h3>
            <h5 class="text-center border-bottom">TAHUN AKADEMIK {{$data['ta']}}</h5>
            
            <div class="row mb-3">
                <div class="col">
                    <figure class="figure border p-1 mb-0 float-end" >
                        <img src="{{$data['photo_image'] ? url('/photo/'.$data['photo_image']) : url('/assets/blank_photo.jpg')}}" 
                        style="height: 260px !important; width: 200px"
                        class="figure-img img-thumbnail border-0" alt="{{$data['photo_image']}}">
                        <figcaption class="figure-caption text-center"><h6 class="mb-0"><strong>{{$data['no_daftar']}}</strong></h6></figcaption>
                    </figure>
                    <dl class="row my-2">
                        <dt class="col-12 text-primary  mb-2  border-bottom">A. DATA CALON PESERTA MAHASISWA BARU</dt>
                
                        <dd class="col-3 mb-0">Nama Lengkap</dd>
                        <dt class="col-9 mb-0">{{$data['nama_depan']}} {{$data['nama_belakang']}}</dt>
                        <dd class="col-3 mb-0">Jenis Kelamin</dd>
                        <dt class="col-9 mb-0">{{$data['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</dt>
                        <dd class="col-3 mb-0">NISN</dd>
                        <dt class="col-9 mb-0">{{$data['nisn']}}</dt>
                        <dd class="col-3 mb-0">NIK</dd>
                        <dt class="col-9 mb-0">{{$data['nik']}}</dt>
                        <dd class="col-3 mb-0">Tpt/Tgl Lahir</dd>
                        <dt class="col-9 mb-0">{{$data['tempat_lahir']}}, {{\Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y')}}</dt>
                        <dd class="col-3 mb-0">Agama</dd>
                        <dt class="col-9 mb-0">{{$data['agama']}}</dt>
                        <dd class="col-3 mb-0">Alamat</dd>
                        <dt class="col-9 mb-0">{{$data['alamat']}}</dt>
                        <dd class="col-3 mb-0">Kel./Kec.</dd>
                        <dt class="col-9 mb-0">{{$data['kelurahan']}}, {{$data['kecamatan']}} </dt>
                        <dd class="col-3 mb-0">Kota/Provinsi</dd>
                        <dt class="col-9 mb-0">{{$data['kabkota']}}, {{$data['provinsi']}} </dt>
                        <dd class="col-3 mb-0">Dusun</dd>
                        <dt class="col-9 mb-0">{{$data['dusun']}}</dt>
                        <dd class="col-3 mb-0">RT/RW</dd>
                        <dt class="col-9 mb-0">{{$data['rt']}} / {{$data['rw']}} </dt>
                        <dd class="col-3 mb-0">Kewarganegaraan</dd>
                        <dt class="col-9 mb-0">{{$data['warganegara']}}</dt>
                        <dd class="col-3 mb-0">Kodepos</dd>
                        <dt class="col-9 mb-0">{{$data['kodepos']}}</dt>
                        <dd class="col-3 mb-0">No. HP./WA.</dd>
                        <dt class="col-9 mb-0">{{$data['hp']}}</dt>
                        <dd class="col-3 mb-0">Email</dd>
                        <dt class="col-9 mb-0">{{$data['email']}}</dt>
                        @if($data['jenis_daftar']==1)
                        <dd class="col-3 mb-0">Asal PT.</dd>
                        <dt class="col-9 mb-0">{{$data['kode_pt_asal']}} - {{$data['nama_pt_asal']}}</dt>
                        <dd class="col-3 mb-0">Asal PS.</dd>
                        <dt class="col-9 mb-0">{{$data['kode_ps_asal']}} - {{$data['nama_ps_asal']}}</dt>
                        @else
                        <dd class="col-3 mb-0">Asal Sekolah</dd>
                        <dt class="col-9 mb-0">{{$data['asal_sekolah_npsn']}} - {{$data['asal_sekolah']}} - {{$data['tahun_lulus']}}</dt>
                        @endif
                    </dl> 
                        
                    <dl class="row my-2">
                        <dt class="col-12 text-primary  mb-2  border-bottom">B. DATA ORANG TUA / WALI</dt>

                        <dd class="col-3 mb-0">Nama Lengkap</dd>
                        <dt class="col-9 mb-0">{{$data['ortu_nama_depan']}} {{$data['ortu_nama_belakang']}}</dt>
                        <dd class="col-3 mb-0">Jenis Kelamin</dd>
                        <dt class="col-9 mb-0">{{$data['ortu_jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</dt>
                        <dd class="col-3 mb-0">Tpt/Tgl Lahir</dd>
                        <dt class="col-9 mb-0">{{$data['ortu_tempat_lahir']}}, {{\Carbon\Carbon::parse($data['ortu_tanggal_lahir'])->format('d M Y')}}</dt>
                        <dd class="col-3 mb-0">Agama</dd>
                        <dt class="col-9 mb-0">{{$data['ortu_agama']}}</dt>
                        <dd class="col-3 mb-0">Pekerjaan</dd>
                        <dt class="col-9 mb-0 text-truncate">{{$data['ortu_pekerjaan']}}</dt>
                        <dd class="col-3 mb-0">Alamat</dd>
                        <dt class="col-9 mb-0 text-truncate">{{$data['ortu_alamat']}}</dt>
                        <dd class="col-3 mb-0">Kota/Provinsi</dd>
                        <dt class="col-9 mb-0 text-truncate">{{$data['ortu_kabkota']}} {{$data['ortu_provinsi']}} </dt>
                        <dd class="col-3 mb-0">Kewarganegaraan</dd>
                        <dt class="col-9 mb-0 text-truncate">{{$data['ortu_warganegara']}}</dt>
                        <dd class="col-3 mb-0">Kodepos</dd>
                        <dt class="col-9 mb-0 text-truncate">{{$data['ortu_kodepos']}}</dt>
                        <dd class="col-3 mb-0 text-truncate">Hubungan Keluarga</dd>
                        <dt class="col-9 mb-0 text-truncate">{{$data['ortu_hubungan']}}</dt>

                    </dl>
                    <dl class="row my-2">
                        <dt class="col-12 text-primary  mb-2  border-bottom">C. PILIHAN JURUSAN</dt>

                        <dd class="col-3 mb-0">Jurusan</dd>
                        <dt class="col-9 mb-2">
                            <ol class="list-group list-group-numbered border-0 p-0">
                                <li class="list-group-item border-0 p-0">{{$data['jurusan']}}</li>
                                <li class="list-group-item border-0 p-0">{{$data['jurusan2']}}</li>
                                <li class="list-group-item border-0 p-0">{{$data['jurusan3']}}</li>
                            </ol>
                        </dt>
                        <dd class="col-3 mb-0">No. Daftar</dd>
                        <dt class="col-9 mb-0">{{$data['no_daftar']}}</dt>
                        <dd class="col-3 mb-0">Tanggal Daftar</dd>
                        <dt class="col-9 mb-0">{{\Carbon\Carbon::parse($data['waktu'])->format('d M Y')}}</dt>
                        {{-- <dd class="col-sm-3 mb-0"></dd> --}}
                        <dt class="col-12 text-primary  mb-2"><i class="bi bi-check-square"></i> <strong>Data tersebut diatas adalah BENAR, Saya akan menanggung RESIKO apabila data diatas adalah SALAH</strong></dt>
                    </dl>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-4 text-center">
                    <p class="mb-0">Calon Mahasiswa Baru,</p>
                    @if($data['ttd_image'])
                    <img src="{{url('/ttd/'.$data['ttd_image'])}}" alt="{{$data['ttd_image']}}"
                        style="max-width: 60%; image-position: center center; max-height: 50px">
                    @else
                    <div style="height: 50px"></div>
                    @endif
                    <p>(<strong> {{$data['nama_depan']}} {{$data['nama_belakang']}} </strong>)</p>
                </div>
                <div class="col-4 text-center">
                    {!! QrCode::size(50)->generate($data['qrcode']) !!}
                </div>
                <div class="col-4 text-center">
                    <p class="mb-0">Mengetahui Orang Tua/Wali,</p>
                    @if($data['ortu_ttd_image'])
                    <div style="height: 50px">
                    <img src="{{url('/ortuttd/'.$data['ortu_ttd_image'])}}" alt="{{$data['ortu_ttd_image']}}"
                        style="max-width: 60%; image-position: center center; max-height: 50px">
                    </div>
                    @else
                    <div style="height: 50px"></div>
                    @endif
                    <p>(<strong> {{$data['ortu_nama_depan']}} {{$data['ortu_nama_belakang']}} </strong>)</p>
                </div>
            </div>
            <hr class="mb-1">
            @livewire('kontak-person')
</div>