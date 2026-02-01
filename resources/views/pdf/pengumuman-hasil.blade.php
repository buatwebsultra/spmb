@foreach ($hasil as $key=>$val)        
    <div class="border p-3" style="width: 210mm !important; height: 297mm !important">
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
        <hr class="mb-1">
        @livewire('kontak-person')
    </div>
    
@endforeach