<div class="container">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @error('tanggal')
        <div class="alert alert-danger mb-2">
            {{ $message }}
        </div>
        @enderror
        @error('jam')
        <div class="alert alert-danger mb-2">
            {{ $message }}
        </div>
        @enderror
        @error('ruangan')
        <div class="alert alert-danger mb-2">
            {{ $message }}
        </div>
        @enderror
        @error('jurusan_id_pilih')
        <div class="alert alert-danger mb-2">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="card shadow border-primary">
        <h5 class="card-header bg-primary text-light">Hasil Ujian
            {{-- <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    <input  wire:model="no_daftar" type="text" class="form-control" placeholder="Nomor Daftar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm-nd">
                    <button {{$no_daftar!='' ?'':'disabled'}} type="button" class="btn btn-sm btn-outline-light ml-2 " @if($no_daftar!='') data-bs-toggle="modal" data-bs-target="#staticBackdrop" @endif wire:click="tambah" ><i class="bi bi-cart-plus"></i> Tambah</button>
                </div>
             </span> --}}
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
                        <input style="min-width: 20%" wire:model="query" type="text" class="form-control" placeholder="Cari nama, nomor daftar..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm1">
                        <select wire:model="jurusan_id" id="jurusan_id"  class="form-select form-select-sm " style="max-width: 160px">
                            <option value="">--Filter Jurusan--</option>
                            @foreach ($listjurusan as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                        </select>
                        <select wire:model="f_ruangan" id="f_ruangan"  class="form-select form-select-sm " style="max-width: 160px">
                            <option value="">--Filter Ruangan--</option>
                            <option value="Kosong">Belum Ditentukan</option>
                            @foreach ($filter_ruangan as $val)
                                <option value="{{$val}}">{{$val}}</option>
                            @endforeach
                        </select>
                        <select wire:model="f_status" id="f_status"  class="form-select form-select-sm " style="max-width: 160px">
                            <option value="">--Filter Status--</option>
                            <option value="Kosong">Belum Ditentukan</option>
                            @foreach ($filter_status as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                            @endforeach
                        </select>
                        <select wire:model="f_tanggal" id="f_tanggal"  class="form-select form-select-sm " style="max-width: 160px">
                            <option value="">--Filter Tanggal--</option>
                            <option value="Kosong">Belum Ditentukan</option>
                            @foreach ($filter_tanggal as $val)
                                <option value="{{$val->tanggal_pengumuman}}">{{$val->tanggal_label}}</option>
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
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Ruangan</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Pengumuman</th>
                            
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$val)
                        <tr>
                            <td class="text-center">{{$data->firstItem() + $key}}</td>
                            <td>{{$val->no_daftar}}</td>
                            <td> {{$val->nama_depan}} {{$val->nama_belakang}}</td>
                            <td>
                                @if($val->onedit==0)
                                {{$val->jurusan_pilihan ? $val->jurusan_pilihan : $val->jurusan}}
                                @else
                                <select wire:model.defer="jurusan_id_pilih" id="jurusan_id_pilih"  class="form-select form-select-sm" style="max-width: 160px">
                                    <option value="">--Jurusan Pilihan--</option>
                                    @foreach ($jurusan_pilihan as $keyj => $valj)
                                        <option value="{{$valj->id}}">Pil {{$keyj+1}}. {{$valj->nama}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </td>
                            <td>{{$val->ruangan}}</td>
                            <td>
                                @if($val->onedit==0)
                                    {{$val->nilai}}
                                @else
                                <input wire:model.defer="nilai" style="width: 90px !important;"  type="number" max="100" min="0" step="1" class="form-control form-control-sm" placeholder="cth: 80" aria-label=".form-control-sm exampler">
                                @endif
                            </td>
                            <td>
                                @if($val->onedit==0)
                                    <small>{{$val->status_label}}</small>
                                @else
                                @foreach ($filter_status as $valf)
                                <div class="form-check form-check-sm form-check-inline">
                                    <input wire:model.defer="status" value="{{$valf->id}}" 
                                    class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault{{$valf->id}}"
                                    @if($val->status==$valf->id) checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault{{$valf->id}}">
                                      {{$valf->nama}}
                                    </label>
                                </div>
                                @endforeach
                                
    

                                @endif
                            </td>
                            <td>
                                @if($val->onedit==0)
                                    @if($val->tanggal_pengumuman)
                                    {{\Carbon\Carbon::parse($val->tanggal_pengumuman)->translatedFormat('d F Y')}}
                                    @endif
                                @else
                                <input wire:model.defer="tanggal_pengumuman" type="date" class="form-control form-control-sm" placeholder=".form-control-sm" aria-label=".form-control-sm examplet">
                                @endif
                            </td>
                            
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    
                                    @if($val->onedit>0)
                                    <button wire:click="save({{$val->id}})"type="button" class="btn btn-success"><i class="bi bi-check-lg"></i></button>
                                    <button wire:click="batal"type="button" class="btn btn-secondary"><i class="bi bi-x"></i></button>
                                    @else
                                    <button wire:click="edit({{$val->id}})"type="button" class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                    <button @if($val->status_daftar_ulang!=null) disabled @endif wire:click="confirmHapus({{$val->id}})" type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus"><i class="bi bi-trash"></i></button>
                                    @endif

                                    
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
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        Livewire.on('confirmHapus', idp => {
            if (confirm('Anda akan menghapus data Seleksi ini?')){
                Livewire.emit('hapusHasil', idp);
            }
        });
    });
</script>
@endpush