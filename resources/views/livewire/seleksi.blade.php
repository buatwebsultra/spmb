<div class="container">
    <div class="card mb-3  shadow border-primary">
        <div class="card-header  bg-primary text-light">
            Jadwal & Peserta Ujian
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    <a href="{{url('/cetak/jadwal')}}" target="blank" class="btn btn-sm btn-outline-light ml-2 " ><i class="bi bi-printer"></i> Cetak</a>
                </div>
             </span>
        </div>
        <div class="card-body" style="overflow: auto; max-height: 400px">
            @foreach ($jadwal as $key=>$val)
                
            <div class="border p-3 shadow mb-3" style="width: 210mm !important; height: 297mm !important">
                <h5 class="text-center">JADWAL UJIAN MAHASISWA BARU</h1>
                <h6 class="text-center border-bottom">TAHUN AKADEMIK {{$setting->ta_pendaftaran}}</h5>
                <div class="row">
                    <div class="col">
                        <dl class="row my-4">
                            <dd class="col-3 mb-0">Tanggal</dd>
                            <dt class="col-9 mb-0">{{\Carbon\Carbon::parse($val['tanggal'])->isoFormat('dddd, D MMMM Y')}}</dt>
                            <dd class="col-3 mb-0">Jam</dd>
                            <dt class="col-9 mb-0">{{\Carbon\Carbon::parse($val['jam'])->format('H:i')}} WITA</dt>
                            <dd class="col-3 mb-0">Ruangan</dd>
                            <dt class="col-9 mb-0">{{$val['ruangan']}}</dt>
                        </dl>
                        <table class="table table-sm table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr >
                                    <th class="text-center">#</th>
                                    <th>No. Daftar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan</th>
                                    <th class="text-end">Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($val['data'] as $key=>$v)
                                <tr >
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$v->no_daftar}}</td>
                                    <td>{{$v->nama_depan}} {{$v->nama_belakang}}</td>
                                    <td>{{$v->jurusan}}</td>
                                    <td style="width: 250px;">
                                        <div class="row">
                                            @if($loop->iteration % 2 == 0)
                                            <div class="col-6"></div><div class="col-6">{{$key+1}}{{str_pad('.', 3, ".", STR_PAD_RIGHT)}}</div>
                                            @else
                                            <div class="col-6">{{$key+1}}{{str_pad('.', 3, ".", STR_PAD_RIGHT)}}</div><div class="col-6"></div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card mb-3  shadow border-primary">
        <div class="card-header  bg-primary text-light">
            Pengumuman Hasil
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    <a href="{{url('/cetak/hasil')}}"  target="blank" class="btn btn-sm btn-outline-light ml-2 " ><i class="bi bi-printer"></i> Cetak</a>
                </div>
             </span>
        </div>
        <div class="card-body" style="overflow: auto; max-height: 400px">
            @foreach ($hasil as $key=>$val)
                
            <div class="border p-3 shadow mb-3" style="width: 210mm !important; height: 297mm !important">
                <h5 class="text-center">HASIL UJIAN MAHASISWA BARU</h1>
                <h6 class="text-center border-bottom">TAHUN AKADEMIK {{$setting->ta_pendaftaran}}</h5>
                <div class="row">
                    <div class="col">
                        <dl class="row my-4">
                            <dd class="col-3 mb-0">Tanggal</dd>
                            <dt class="col-9 mb-0">{{\Carbon\Carbon::parse($val['tanggal'])->isoFormat('dddd, D MMMM Y')}}</dt>
                            <dd class="col-3 mb-0">Jam</dd>
                            <dt class="col-9 mb-0">{{\Carbon\Carbon::parse($val['jam'])->format('H:i')}} WITA</dt>
                            <dd class="col-3 mb-0">Ruangan</dd>
                            <dt class="col-9 mb-0">{{$val['ruangan']}}</dt>
                        </dl>
                        <table class="table table-sm table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr >
                                    <th class="text-center">#</th>
                                    <th>No. Daftar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan</th>
                                    <th class="text-end">Nilai</th>
                                    <th class="text-start">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($val['data'] as $key=>$v)
                                <tr >
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$v->no_daftar}}</td>
                                    <td>{{$v->nama_depan}} {{$v->nama_belakang}}</td>
                                    <td>{{$v->jurusan}}</td>
                                    <td class="text-end">{{$v->nilai}}</td>
                                    <td class="text-start">{{$v->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
