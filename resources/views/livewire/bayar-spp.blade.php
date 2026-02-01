<div class="container">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="card shadow border-primary">
        <h5 class="card-header bg-primary text-light">Data Pembayaran Biaya Masuk
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    <input  wire:model="nim" type="text" class="form-control" placeholder="NIM" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm-nd">
                    <button {{$nim!='' ?'':'disabled'}} type="button" class="btn btn-sm btn-outline-light ml-2 " @if($nim!='') data-bs-toggle="modal" data-bs-target="#staticBackdrop" @endif 
                    wire:click="tambah" ><i class="bi bi-cart-plus"></i> Tambah</button>
                    @if($inputnamafile==null)
                        <button @if(count($data)<=0) disabled @endif wire:click="toexport" class="btn btn-sm btn-warning"><i class="bi bi-table"></i> Export Data</button>
                    @else
                        <span class="input-group-text" id="basic-addon1x">Nama File</span>
                        <input wire:model="namafile" type="text" class="form-control" placeholder="Nama file export" aria-label="Namafile" aria-describedby="basic-addon1x">
                        <button wire:click="batalexport" class="btn btn-sm btn-warning"><i class="bi bi-x-lg"></i></button>
                        <button @if(count($data)<=0) disabled @endif  wire:click="export" class="btn btn-sm btn-success"><i class="bi bi-table"> Export</i></button>
                    @endif
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
                        <input style="min-width: 40%" wire:model="query" type="text" class="form-control" placeholder="Cari nama, nim, nomor daftar..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm1">
                        <select wire:model="filjurusan" id="filjurusan"  class="form-select form-select-sm " style="max-width: 150px">
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
                            {{-- <th>No. Daftar</th> --}}
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th  class="text-end">SPP</th>
                            <th  class="text-end">Pendidikan</th>
                            <th  class="text-end">Almamater</th>
                            <th  class="text-end">Lain</th>
                            <th  class="text-end">Jumlah</th>
                            <th>Waktu</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$val)
                        <tr>
                            <td class="text-center">{{$data->firstItem() + $key}}</td>
                            {{-- <td>{{$val->no_daftar}}</td> --}}
                            <td><strong>{{$val->nim}}</strong></td>
                            <td> {{$val->nama_depan}} {{$val->nama_belakang}}</td>
                            <td>{{$val->jurusan}}</td>
                            <td class="text-end">{{number_format($val->spp, 0, ',', '.')}}</td>
                            <td class="text-end">{{number_format($val->pendidikan, 0, ',', '.')}}</td>
                            <td class="text-end">{{number_format($val->almamater, 0, ',', '.')}}</td>
                            <td class="text-end">{{number_format($val->lain, 0, ',', '.')}}</td>
                            <td class="text-end"><strong>{{number_format($val->jumlah, 0, ',', '.')}}</strong></td>
                            <td>{{\Carbon\Carbon::parse($val->waktu_bayar)->format('d M Y H:i')}}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button wire:click="confirmHapus({{$val->idb}})" type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus"><i class="bi bi-trash"></i></button>
                                    {{-- <button wire:click="edit({{$val->id}})"type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="bi bi-pencil"></i></button> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }} 
        </div>
    </div>

    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Pembayaran Biaya Masuk @if ($idp) <strong>{{$nim}}</strong> @endif </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($idp)
                    <div class="row mb-3">
                        <div class="col">
                            <dl class="row my-4">
                                <dd class="col-sm-3 mb-0">NIM</dd>
                                <dt class="col-sm-9 mb-0">{{$nim}}</dt>
                                <dd class="col-sm-3 mb-0">Nama Lengkap</dd>
                                <dt class="col-sm-9 mb-0">{{$nama_depan}} {{$nama_belakang}}</dt>
                                <dd class="col-sm-3 mb-0">Jenis Kelamin</dd>
                                <dt class="col-sm-9 mb-0">{{$jenis_kelamin=='L'?'Laki-laki':'Perempuan'}}</dt>
                                <dd class="col-sm-3 mb-0">Jurusan</dd>
                                <dt class="col-sm-9 mb-0">{{$jurusan}}</dt>
                                <dd class="col-sm-3 mb-0">No. Daftar</dd>
                                <dt class="col-sm-9 mb-0">{{$no_daftar}}</dt>
                                <dd class="col-sm-3 mb-0">Tanggal Daftar Ulang</dd>
                                <dt class="col-sm-9 mb-0">{{\Carbon\Carbon::parse($waktu)->format('d M Y')}}</dt>
                            </dl>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1" style="width: 100px;">Waktu</span>
                                <input type="datetime-local" wire:model="waktu_bayar"  class="form-control" id="exampleFormControlInput1u" placeholder="hh/bb/tttt jj:mm:dd">
                            </div> 
                            <div class="input-group mb-0">
                                <span class="input-group-text"  style="width: 100px;">SPP</span>
                                <input wire:model="spp" type="number"class="form-control text-end" id="exampleFormControlInputs" placeholder="0">
                            </div>
                            <div class="input-group mb-0">
                                <span class="input-group-text"  style="width: 100px;">Pendidikan</span>
                                <input wire:model="pendidikan" type="number"class="form-control text-end" id="exampleFormControlInputp" placeholder="0">
                            </div>
                            <div class="input-group mb-0">
                                <span class="input-group-text"  style="width: 100px;">Almamater</span>
                                <input wire:model="almamater" type="number"class="form-control text-end" id="exampleFormControlInputa" placeholder="0">
                            </div>
                            <div class="input-group mb-0">
                                <span class="input-group-text"  style="width: 100px;">Lain</span>
                                <input wire:model="lain" type="number"class="form-control text-end" id="exampleFormControlInputl" placeholder="0">
                            </div>
                            <div class="input-group mb-0">
                                <span class="input-group-text"  style="width: 100px;">Total</span>
                                <input wire:model="jumlah" disabled type="number"class="form-control text-end" id="exampleFormControlInputa" placeholder="0">
                            </div>

                        </div>
                    </div>
                    @else
                    <div class="row mb-3">
                        <div class="col">
                            @if($sudah_bayar)
                            <p><strong>{{$nama_depan}} {{$nama_belakang}}</strong> Jurusan: <strong>{{$jurusan}}</strong>, Sudah melakukan pembayaran</p>
                            @else
                            <p>Nomor Induk Mahasiswa : <strong class="text-danger">{{$nim}}</strong> tidak ditemukan</p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Batal</button>
                    @if($idp)
                    <button type="button" wire:click="save"  wire:loading.attr="disabled" data-bs-dismiss="modal" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        Livewire.on('confirmHapus', msg => {
            if (confirm(msg)){
                Livewire.emit('hapusBayar');
            };
        });
    });
</script>
@endpush