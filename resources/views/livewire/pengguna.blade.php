<div class="container">
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
    @endif
    @error('name')
    <div class="alert alert-danger mb-2">
        {{ $message }}
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger mb-2">
        {{ $message }}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger mb-2">
        {{ $message }}
    </div>
    @enderror
    <div class="card mb-3 shadow border-primary">
        <div class="card-header bg-primary text-light">
            Pengguna
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                    <button type="button" class="btn btn-sm btn-outline-light ml-2 "  data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
                    wire:click="tambah" ><i class="bi bi-person-plus-fill"></i> User Admin</button>
                </div>
            </span>
        </div>
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
                        <input style="min-width: 40%" wire:model="query" type="text" class="form-control" placeholder="Cari nama, email..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm1">
                        <select wire:model="fillevel" id="fillevel"  class="form-select form-select-sm " style="max-width: 150px">
                            <option value="">--Filter Level--</option>
                            @foreach ($pillevel as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Verifikasi Email</th>
                            <th>Level</th>
                            <th>Pendaftar</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$val)
                        <tr>
                            <td>{{$data->firstItem()+$key}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->email}}</td>
                            <td>{{\Carbon\Carbon::parse($val->email_verified_at)->isoFormat('dddd, D MMM YYYY')}}</td>
                            <td><small>{{$val->level}}</small></td>
                            <td>
                                @if($val->pendaftaran_id>0)
                                <small>
                                <p class="mb-0">
                                    <a href="{{url('pendaftaran/show?idp='.$val->pendaftaran_id)}}" class="btn btn-link p-0 m-0 align-baseline">{{$val->nama_depan}} {{$val->nama_belakang}}</a>
                                    <br>
                                    {{$val->no_daftar}}
                                </p>
                                <small>
                                @endif
                            </td>
                            <td  class="text-end">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button 
                                        {{-- @if($val->pendaftaran_id>0) disabled @endif  --}}
                                        wire:click="edit({{$val->id}})"type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="bi bi-pencil"></i></button>
                                    @if($val->id>1)
                                    <button @if($val->pendaftaran_id>0) disabled @endif wire:click="confirmHapus({{$val->id}})"type="button" class="btn btn-danger"><i class="bi bi-x"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$data->links()}}
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$idu==null ? 'Tambah' : 'Edit'}} User Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-2 input-group-sm">
                        <span class="input-group-text" id="basic-addon1" style="width: 10rem">Nama Lengkap</span>
                        <input required wire:model="name" type="text" class="form-control {{!$name ? 'is-invalid' : 'is-valid'}}" placeholder="Nama lengkap user" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-2 input-group-sm">
                        <span class="input-group-text" id="basic-addon1e" style="width: 10rem">User Email</span>
                        <input required wire:model="email" type="text" class="form-control {{!$email ? 'is-invalid' : 'is-valid'}}" placeholder="Email aktif user" aria-label="Email" aria-describedby="basic-addon1e">
                    </div>
                    <div class="input-group mb-2 input-group-sm">
                        <span class="input-group-text" id="basic-addon1p" style="width: 10rem">User Password</span>
                        <input required wire:model="password" type="text" class="form-control {{!$password ? 'is-invalid' : 'is-valid'}}" placeholder="{{$idu>0 ? 'Kosongkan jika tidak ingin merubah' : 'Password user'}}" aria-label="password" aria-describedby="basic-addon1p">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="clear" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Batal</button>
                    <button type="button" wire:click="save"  wire:loading.attr="disabled" data-bs-dismiss="modal" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
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
                Livewire.emit('hapusUser');
            };
        });
    });
</script>
@endpush