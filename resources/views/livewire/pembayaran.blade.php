<div class="container container-fluid">
    <div class="card shadow border-primary">
        <h5 class="card-header bg-primary text-light">Data Pembayaran
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    <a href="{{url('/pembayaran/pendaftaran')}}" class="btn btn-sm btn-outline-light ml-2 " ><i class="bi bi-cart-plus"></i> Pendaftaran</a>
                    <a href="{{url('/pembayaran/spp')}}" class="btn btn-sm btn-outline-light ml-2 " ><i class="bi bi-cart-plus"></i> Biaya Masuk</a>
                </div>
             </span>
        </h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm2-provinsi"> Per Page: 
                            <select wire:model="perpage" id="perpage"  class="form-select form-select-sm ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </span>
                        @if ($query!='')
                        <button wire:click="$set('query', '')" class="btn btn-outline-danger" type="button" id="button-addon2x"><i class="bi bi-x"></i></button>
                        @endif
                        <input style="min-width: 40%" wire:model="query" type="text" class="form-control" placeholder="Cari nama, nim, no. daftar..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm1">
                        <span class="input-group-text" id="inputGroup-sizing-sm2-provinsi"> Status Bayar:
                            <select wire:model="status_bayar_pendaftaran" id="jurusan_id"  class="form-select form-select-sm " style="max-width: 150px">
                                <option value="">--Biaya Pendaftaran--</option>
                                <option value="1">Sudah</option>
                                <option value="0">Belum</option>
                            </select>
                            <select wire:model="status_bayar_spp" id="jurusan_id"  class="form-select form-select-sm " style="max-width: 150px">
                                <option value="">--Biaya Masuk--</option>
                                <option value="1">Sudah</option>
                                <option value="0">Belum</option>
                            </select>
                        </span>
                        <select wire:model="jurusan_id" id="jurusan_id"  class="form-select form-select-sm " style="max-width: 150px">
                            <option value="">--Filter Jurusan--</option>
                            @foreach ($listjurusan as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover">
                    <thead>
                        <tr >
                            <th class="text-center">#</th>
                            <th>No. Daftar</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th  class="text-end">Pendaftaran</th>
                            <th>Waktu</th>
                            <th  class="text-end">Biaya Masuk</th>
                            <th>Waktu</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$val)
                        <tr>
                            <td class="text-center">{{$data->firstItem() + $key}}</td>
                            <td>{{$val->no_daftar}}</td>
                            <td>{{$val->nim}}</td>
                            <td> {{$val->nama_depan}} {{$val->nama_belakang}}</td>
                            <td>{{$val->jurusan}}</td>
                            <td class="text-end">@if($val->waktu_bayar_pendaftaran){{number_format($val->bayar_pendaftaran, 0, ',', '.')}}@endif</td>
                            <td><small>@if($val->waktu_bayar_pendaftaran){{\Carbon\Carbon::parse($val->waktu_bayar_pendaftaran)->format('d M Y H:i')}}@endif</small></td>
                            <td class="text-end">@if($val->bayar_spp){{number_format($val->bayar_spp, 0, ',', '.')}}@endif</td>
                            <td><small>@if($val->waktu_bayar_spp){{\Carbon\Carbon::parse($val->waktu_bayar_spp)->format('d M Y H:i')}}@endif</small></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }} 
        </div>
    </div>
</div>
