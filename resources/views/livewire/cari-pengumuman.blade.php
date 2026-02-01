<div>
    
    <div class="card border shadow border-primary mb-3">
        <div class="card-body">
            <h4>Pengumuman</h4>
            <div class="input-group mb-3">
                <input wire:model="no_daftar" type="text" class="form-control" placeholder="Input nomor pendaftaran" aria-label="nomor pendaftaran" aria-describedby="button-addon2">
                <button wire:click="cari" class="btn btn-outline-primary" type="button" id="button-addon2"><i class="bi bi-search"></i> </button>
            </div>
            @if($data)
                <div class="card border shadow border-{{($data['status_lulus']>0) ? 'primary' : 'danger'}}">
                    <div class="card-body">
                        <div class="row border-bottom d-flex align-items-center pb-2 mb-2">
                            <div class="col-2">
                                <span class="float-start">
                                    <img src="{{url('/logo')}}" style="width: 60px;" alt="StikesPIK">
                                </span>
                            </div>
                            <div class="col">
                                <h5 class="text-center">{{$instansi}}</h1>
                                <h6 class="text-center">PENGUMUMAN HASIL SELEKSI MANDIRI {{$ta}}</h5>
                                
                            </div>
                            <div class="col-2">
                                <span class="float-end">
                                    {!! QrCode::size(50)->generate($data['qrcode']) !!}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 text-center">
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
                                        Informasi persyaratan pendaftaran ulang calon mahasiswa baru dapat dilihat <a href="{{$link_syarat_daftar_ulang}}" target="blank" class="btn-link"><strong>disini</strong></a>
                                    </dt>
                                    <dt class="col-12 mb-2">
                                        Anda dapat mencetak kembali Kartu Tanda Peserta Ujuan <a href="{{url('/cetak/kartu-ujian/'.$data['id'])}}" target="blank" class="btn-link"><strong>disini</strong></a>
                                    </dt>
                                    <dt class="col-12 mb-0 text-center">
                                        <a target="blank" href="{{url('/pdf-pengumuman/'.$data['id'])}}" class="btn btn-success"><i class="bi bi-download"></i> Unduh Pengumuman</a>
                                    </dt>
                                    @else
                                    <h4 class="text-danger">Maaf, Anda dinyatakan TIDAK LULUS seleksi mandiri {{$ta}}</h4>
                                    @endif
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-grid">
                                <button wire:click="tutup" class="btn btn-danger"><i class="bi bi-x-lg"></i> Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if($oncari)
                <h4 class="text-danger">Data Tidak Ditemukan</h4>
                @endif
            @endif
        </div>
    </div>
    
</div>
