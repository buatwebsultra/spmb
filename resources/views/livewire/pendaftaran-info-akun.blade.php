<div class="container container-fluid">
    <div class="row">
        <div class="col">
            <dl class="row my-4">
                <dd class="col-sm-3 mb-0">Nama</dd>
                <dt class="col-sm-9 mb-0">{{$akun['name']}}</dt>
                <dd class="col-sm-3 mb-0">Email</dd>
                <dt class="col-sm-9 mb-0">{{$akun['email']}}</dt>
                <dd class="col-sm-3 mb-0">Tanggal Akun</dd>
                <dt class="col-sm-9 mb-0">{{\Carbon\Carbon::parse($akun['created_at'])->isoFormat('dddd, D MMMM YYYY')}}</dt>
            </dl>
        </div>
        @if($data)
        <div class="col">
            <dl class="row my-4">
                <dd class="col-sm-4 mb-0">Tanggal Daftar</dd>
                <dt class="col-sm-8 mb-0">{{$akun['tanggal_daftar']}}</dt>
                <dd class="col-sm-4 mb-0">No. Daftar</dd>
                <dt class="col-sm-8 mb-0 text-success">{{$akun['no_daftar']}}</dt>
                <dd class="col-sm-4 mb-0">Pilihan 1 Jurusan</dd>
                <dt class="col-sm-8 mb-0 text-success">{{$data['jurusan']}}</dt>
                @if($data['nim']!=null)
                <dd class="col-sm-4 mb-0">NIM</dd>
                <dt class="col-sm-8 mb-0 text-success">{{$data['nim']}}</dt>
                @endif
            </dl>
        </div>
        @endif
    </div>
</div>