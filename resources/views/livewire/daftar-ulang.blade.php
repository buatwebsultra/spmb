<div class="container">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="card shadow border-primary">
        <h5 class="card-header bg-primary text-light">Daftar Ulang
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    {{-- <input  wire:model="no_daftar" type="text" class="form-control" placeholder="Nomor Pendaftaran" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm-nd"> --}}
                    {{-- <button {{$no_daftar!='' ?'':'disabled'}} type="button" class="btn btn-sm btn-outline-light ml-2 " @if($no_daftar!='') data-bs-toggle="modal" data-bs-target="#staticBackdrop" @endif wire:click="tambah" ><i class="bi bi-cart-plus"></i> Tambah</button> --}}
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
                            <th>No. Daftar</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Waktu</th>
                            <th>Biaya Masuk</th>
                            <th>HP./WA</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$val)
                        <tr>
                            <td class="text-center">{{$data->firstItem() + $key}}</td>
                            <td>{{$val->no_daftar}}</td>
                            <td><strong>{{$val->nim}}</strong></td>
                            <td> {{$val->nama_depan}} {{$val->nama_belakang}}</td>
                            <td>{{$val->jurusan}}</td>
                            <td>{{\Carbon\Carbon::parse($val->waktu_daftar_ulang)->format('d M Y H:i')}}</td>
                            <td>
                                @if($val->status_spp>0)
                                <i class="bi bi-check-lg text-success"></i>
                                @else
                                <small class="text-danger">BELUM DIBAYAR</small>
                                @endif
                            </td>
                            <td>
                                @if($val->hp!=null || $val->hp!='') <a href="https://web.whatsapp.com/send?phone=62{{substr($val->hp, 1)}}"  target="blank" class="btn btn-sm btn-outline-info text-dark" style="border-color: #25D366"><i class="bi bi-whatsapp" style="color: #25D366"></i> <strong>{{$val->hp}}</strong></a>@endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    @if($val->status_spp<=0)
                                    <button  wire:click="confirmHapus({{$val->id}})" type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Daftar Ulang"><i class="bi bi-trash"></i></button>
                                    {{-- <button wire:click="edit({{$val->id}})"type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="bi bi-pencil"></i></button> --}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($data){{ $data->links() }} @endif
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        const toastElList = document.querySelectorAll('.toast');
        const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));

        Livewire.on('confirmHapus', nama => {
            if (confirm('Anda akan menghapus Daftar Ulang Maba ('+nama+')?')){
                Livewire.emit('hapusDu');
            };
        });

    });

    
    </script>
@endpush