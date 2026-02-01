<div class="container">
    {{-- <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}

                <span @click="showMessage = false" class="inline-flex items-center cursor-pointer float-end">
                    <i class="bi bi-x"></i>
                </span>
            </div>
        @endif
    </div> --}}
    <div class="card  shadow border-primary">
        <h5 class="card-header  bg-primary text-light">Data Pendaftaran 
            {{-- <strong>{{count($data)}}</strong> <small>Data</small> --}}
            <span class="float-end">
                <div class="input-group input-group-sm mb-0">
                {{-- <a href="{{ route('pendaftaran.form') }}" class="btn btn-sm btn-outline-light ml-2 " wire:click="tambah" ><i class="bi bi-person-plus-fill"></i> Tambah</a> --}}
                @if($inputnamafile==null)
                <button  @if(count($data)<=0) disabled @endif wire:click="toexport" class="btn btn-sm btn-warning"><i class="bi bi-table"></i> Export Data</button>
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
                        <span class="input-group-text" id="inputGroup-sizing-sm">Per Page: 
                            <select wire:model="perpage" id="perpage"  class="form-select form-select-sm " style="max-width: 80px; min-width: 80px">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </span>

                        
                        <input style="min-width: 40%" wire:model.lazy="query" type="text" class="form-control" placeholder="Cari nisn, no daftar, nama..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm1">
                        {{-- <button wire:click="goCari" class="btn btn-sm btn-outline-success" type="button" id="button-addon2x"><i class="bi bi-search"></i></button> --}}
                        @if ($query!='')
                            <button wire:click="$set('query', '')" class="btn btn-outline-danger" type="button" id="button-addon2xc"><i class="bi bi-x"></i></button>
                        @endif
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                            <div class="form-check">
                                <input wire:model="periode" class="form-check-input" type="checkbox"  id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  Tanggal Daftar
                                </label>
                            </div>
                        </span>
                        <input wire:model="waktu_awal" style="width: 100px" type="date" class="form-control" placeholder="yyyy-mm-dd" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-smx">
                        <input wire:model="waktu_akhir" style="width: 100px"  type="date" class="form-control" placeholder="yyyy-mm-dd" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-smy">
                        <span class="input-group-text" id="inputGroup-sizing-sm2-provinsi">
                            <select wire:model="provinsi_id" id="provinsi_id"  class="form-select form-select-sm " style="max-width: 200px; min-width: 200px">
                                <option value="">--Filter Prov.--</option>
                                @foreach ($provinsi as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                            </select>
                            @if($provinsi_id!='')
                            <select wire:model="kabkota_id" id="kabkota_id"  class="form-select form-select-sm ">
                                <option value="">--Filter Kab/Kota--</option>
                                @foreach ($kabkota as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                            </select>
                            @endif
                        </span>
                        <select wire:model="jurusan_id" id="jurusan_id"  class="form-select form-select-sm ">
                            <option value="">--Filter Pil. Jurusan--</option>
                            @foreach ($jurusan as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                        </select>
                        <select wire:model="filter_upload" id="filter_upload"  class="form-select form-select-sm ">
                            <option value="" selected>--Filter Upload--</option>
                            <option value="photo">Photo Ada</option>
                            <option value="ijazah">Ijazah Ada</option>
                            <option value="no_photo">Photo Tidak Ada</option>
                            <option value="no_ijazah">Ijazah Tidak Ada</option>
                            <option value="tidak_lengkap">Tidak Lengkap</option>
                            <option value="lengkap">Lengkap</option>
                        </select>
                        <select wire:model="filter_jenis_daftar" id="filter_jenis_daftar"  class="form-select form-select-sm ">
                            <option value="" selected>--Filter Jenis Daftar--</option>
                            <option value="0">Lulusan SMA/MA Sederajat</option>
                            <option value="1">Alih Jenjang</option>
                        </select>
                    </div>
                </div>
            </div> 
          <div class="table-responsive">
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>NO. DAFTAR</th>
                        <th>NAMA</th>
                        <th>L/P</th>
                        <th>NISN</th>
                        <th>Asal Sekolah/NPSN/PT</th>
                        <th>Jurusan Pil. 1</th>
                        <th>Tanggal Daftar</th>
                        <th>Provinsi</th>
                        <th>Kab./Kota</th>
                        <th>User</th>
                        <th class="text-center text-nowrap">Photo|Ijazah|Transkip</th>
                        
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$val )
                    <tr>
                        <td class="text-center">{{$data->firstItem() + $key}}.</td>
                        <td><strong class="text-success">{{$val->no_daftar}}</strong></td>
                        
                        <td><strong>{{$val->nama_depan}} {{$val->nama_belakang}}</strong></td>
                        <td>{{$val->jenis_kelamin}}</td>
                        <td>{{$val->nisn}}</td>
                        <td>
                            @if($val->jenis_daftar==0)
                            {{$val->asal_sekolah}}/<small>{{$val->asal_sekolah_npsn}}</small>
                            @else
                            {{$val->kode_pt_asal}}-{{$val->nama_pt_asal}}<br>
                            <small>{{$val->kode_ps_asal}}-{{$val->nama_ps_asal}}</small>
                            @endif

                        </td>
                        <td>{{$val->jurusan}}</td>
                        <td>{{\Carbon\Carbon::parse($val->waktu)->format('d M Y')}}</td>
                        <td><small>{{$val->provinsi}}</small></td>
                        <td><small>{{$val->kabkota}}</small></td>
                        <td><small class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$val->email}}">{{$val->user?$val->user:'-'}}</small></td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col-4 p-1 border rounded">
                                    @if($val->photo_image)
                                        <img wire:click="showImage('{{url('/photo/'.$val->photo_image)}}')" src="{{url('/photo/'.$val->photo_image)}}" style="height: 80px !important;" class="img-thumbnail border-0" alt="{{$val->photo_image}}">
                                    @else
                                    <i class="bi bi-x text-danger"></i>
                                    @endif
                                </div>
                                <div class="col-4 p-1 border rounded">
                                    @if($val->ijazah_image)
                                        <img wire:click="showImage('{{url('/ijazah/'.$val->ijazah_image)}}')" src="{{url('/ijazah/'.$val->ijazah_image)}}" style="height: 80px !important;" class="img-thumbnail border-0" alt="{{$val->ijazah_image}}">
                                        @else
                                        <i class="bi bi-x text-danger"></i>
                                    @endif
                                </div>
                                <div class="col-4 p-1 border rounded">
                                    @if($val->transkip_image)
                                        <img wire:click="showImage('{{url('/transkip/'.$val->transkip_image)}}')" src="{{url('/transkip/'.$val->transkip_image)}}" style="height: 80px !important;" class="img-thumbnail border-0" alt="{{$val->transkip_image}}">
                                        @else
                                        <i class="bi bi-x text-danger"></i>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <button type="button" class="btn btn-outline-dark" @if(!$val->photo_image) disabled @endif>
                                    @if($val->photo_image)
                                    <i class="bi bi-file-image"></i>
                                    @else
                                    <i class="bi bi-x"></i>
                                    @endif
                                </button>
                                <button type="button" class="btn btn-outline-dark" @if(!$val->ijazah_image) disabled @endif>
                                    @if($val->ijazah_image)
                                    <i class="bi bi-file-image"></i>
                                    @else
                                    <i class="bi bi-x"></i>
                                    @endif
                                </button>
                            </div> --}}
                        </td>
                        
                        <td class="text-end">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                <button @if($val->status_bayar>0) disabled @endif wire:click="confirmHapus({{$val->id}})" type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus"><i class="bi bi-trash"></i></button>
                                <button wire:click="edit({{$val->id}})"type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="bi bi-pencil"></i></button>
                                <button wire:click="show({{$val->id}})" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tampilkan"><i class="bi bi-display"></i></button>
                                <a @if($val->hp==null || $val->hp=='') disabled @endif href="https://web.whatsapp.com/send?phone=62{{substr($val->hp, 1)}}"  target="blank" class="btn btn-info text-light" style="background-color: #25D366"><i class="bi bi-whatsapp"></i></a>
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

    <!-- Full screen modal -->
    <div class="modal fade" id="exampleModalImage" tabindex="-1" aria-labelledby="exampleModalImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Image Upload</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($show_image)
                    <img src="{{$show_image}}" class="img-fluid" alt="show_image">
                    @endif
                </div>
            </div>
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
            if (confirm('Anda akan menghapus data Calon Maba ('+nama+')?')){
                Livewire.emit('hapusMaba');
            };
        });
        const myModal = new bootstrap.Modal(document.getElementById('exampleModalImage'));
        Livewire.on('showImage', () => {
            myModal.show();
        });

    });

    
    </script>
@endpush