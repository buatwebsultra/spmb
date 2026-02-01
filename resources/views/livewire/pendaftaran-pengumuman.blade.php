<div class="container container-fluid">
    <p>Hasil Ujian Masuk : <strong>{{$data['status_seleksi']}}</strong>, Pada Jurusan : <strong>{{$data['jurusan_lulus']}}</strong></p>
    <p>Nilai Ujian Masuk : <strong>{{$data['nilai']}}</strong></p>
    @if($data['status']==1)
        <p>Tanggal Daftar Ulang : <strong>{{\Carbon\Carbon::parse($data['daftar_ulang_awal'])->isoFormat('dddd, D MMMM YYYY')}}</strong> s/d <strong>{{\Carbon\Carbon::parse($data['daftar_ulang_akhir'])->isoFormat('dddd, D MMMM YYYY')}}</strong></p>
        @if(!$data['status_daftar_ulang']>0)
        <p>Klik <a href="{{url('daftarulang/form?idp='.$data['id'])}}" class="btn btn-outline-primary"><i class="bi bi-arrow-right"></i> Daftar Ulang</a> untuk melakukan pengisian Form Daftar Ulang</p>
        @endif
        <p>
            <a target="blank" href="{{url('/pdf-pengumuman/'.$data['id'])}}" class="btn btn-success"><i class="bi bi-download"></i> Unduh Pengumuman</a>
        </p>
    @endif
</div>