<div class="container container-fluid">
    <div class="accordion mb-3 shadow-sm" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <div class="d-flex flex-fill">
                    <span class="flex-fill"><strong>Data Form Pendaftaran</strong></span>
                    <h5 class="mb-0 me-3"><span class="badge text-bg-success">{{$data['no_daftar']}}</span></h3>
                </div>   
              
              
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <div class="row mb-3">
                    <div class="col">
                        <dl class="row mb-0">
                            <dt class="col-sm-12 text-primary  mb-2  border-bottom">Biodata</dt>

                            <dd class="col-sm-3 mb-0">Nama Lengkap</dd>
                            <dt class="col-sm-9 mb-0">{{$data['nama_depan']}} {{$data['nama_belakang']}} / {{$data['jenis_kelamin']}}</dt>

                            <dd class="col-sm-3 mb-0">NISN</dd>
                            <dt class="col-sm-9 mb-0">{{$data['nisn']}}</dt>
                            <dd class="col-sm-3 mb-0">Tpt/Tgl Lahir</dd>
                            <dt class="col-sm-9 mb-0">{{$data['tempat_lahir']}}, {{\Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y')}}</dt>
                            <dd class="col-sm-3 mb-0">Agama</dd>
                            <dt class="col-sm-9 mb-0">{{$data['agama']}}</dt>
                            <dd class="col-sm-3 mb-0">Alamat</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['alamat']}}</dt>
                            <dd class="col-sm-3 mb-0">Kota/Provinsi</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['kabkota']}} {{$data['provinsi']}} </dt>
                            <dd class="col-sm-3 mb-0">Kewarganegaraan</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['warganegara']}}</dt>
                            <dd class="col-sm-3 mb-0">Kodepos</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['kodepos']}}</dt>
                            <dd class="col-sm-3 mb-0">No. HP./WA.</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['hp']}}</dt>
                            <dd class="col-sm-3 mb-0">Email</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['email']}}</dt>
                        </dl>  
                    </div>
                    <div class="col">
                        <dl class="row mb-0">
                            <dt class="col-sm-12 text-primary mb-2 border-bottom">Asal Sekolah & Pilihan Jurusan</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">Asal Sekolah</dd>
                            <dt class="col-sm-9 mb-0  text-truncate">{{$data['asal_sekolah']}}</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">Tahun Lulus</dd>
                            <dt class="col-sm-9 mb-0  text-truncate">{{$data['tahun_lulus']}}</dt>
                            <dd class="col-sm-3 mb-3 text-truncate">NPSN Asal Sekolah</dd>
                            <dt class="col-sm-9 mb-3  text-truncate">{{$data['asal_sekolah_npsn']}}</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">Pilihan Jurusan</dd>
                            <dt class="col-sm-9 mb-0  text-truncate">{{$data['jurusan']}}</dt>
                        </dl>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <dl class="row mb-0">
                            <dt class="col-sm-12 text-primary  mb-2  border-bottom">Orang Tua / Wali</dt>

                            <dd class="col-sm-3 mb-0">Nama Lengkap</dd>
                            <dt class="col-sm-9 mb-0">{{$data['ortu_nama_depan']}} {{$data['ortu_nama_belakang']}} / {{$data['jenis_kelamin']}}</dt>
                            <dd class="col-sm-3 mb-0">Tpt/Tgl Lahir</dd>
                            <dt class="col-sm-9 mb-0">{{$data['ortu_tempat_lahir']}}, {{\Carbon\Carbon::parse($data['ortu_tanggal_lahir'])->format('d M Y')}}</dt>
                            <dd class="col-sm-3 mb-0">Agama</dd>
                            <dt class="col-sm-9 mb-0">{{$data['ortu_agama']}}</dt>
                            <dd class="col-sm-3 mb-0">Pekerjaan</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['ortu_pekerjaan']}}</dt>
                            <dd class="col-sm-3 mb-0">Alamat</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['ortu_alamat']}}</dt>
                            <dd class="col-sm-3 mb-0">Kota/Provinsi</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['ortu_kabkota']}} {{$data['ortu_provinsi']}} </dt>
                            <dd class="col-sm-3 mb-0">Kewarganegaraan</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['ortu_warganegara']}}</dt>
                            <dd class="col-sm-3 mb-0">Kodepos</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['ortu_kodepos']}}</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">Hubungan Keluarga</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['ortu_hubungan']}}</dt>
                            
                        </dl>
                    </div>
                    <div class="col">
                        <dl class="row mb-0">
                            <dt class="col-sm-12 text-primary  mb-2  border-bottom">Pendaftaran</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">No. Pendaftaran</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{$data['no_daftar']}}</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">Tanggal Daftar</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{\Carbon\Carbon::parse($data['waktu'])->format('D, d M Y H:i:s')}}</dt>
                            <dd class="col-sm-3 mb-0 text-truncate">Tanggal Update</dd>
                            <dt class="col-sm-9 mb-0 text-truncate">{{\Carbon\Carbon::parse($data['waktu_update'])->format('D, d M Y H:i:s')}}</dt>
                        </dl>
                    </div>
                </div>
                                
            </div>
          </div>
        </div>
    </div>
    <div class="card shadow mb-3">
        <div class="card-header"><strong class="text-primary">Photo Diri</strong>
        </div>
        <div class="card-body">
            <div class="position-relative text-center">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail rounded mx-auto d-block" style="max-height: 500px" alt="photo">
                @elseif ($photo_image)
                    <img src="{{url('/photo/'.$photo_image)}}" class="img-thumbnail rounded mx-auto d-block" style="max-height: 500px" alt="{{$photo_image}}">
                @else
                    <div wire:loading.remove>
                        <input wire:model="photo" accept="image/jpg, image/jpeg, image/png" type="file" class="form-control form-control-sm" id="inputGroupFile01p">
                    </div>
                @endif

                @error('photo') <span class="error text-danger">{{ $message }}</span> @enderror
                <div wire:loading.inline-flex wire:target="photo">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            @if($photo_image)
            <button wire:click="confirmHapusPhoto" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
            @elseif($photo)
            <button wire:click="uploadP" wire:loading.attr="disabled" class="btn btn-sm btn-outline-primary" {{$photo?'':'disabled'}}><i class="bi bi-upload"></i> Upload </button>
            @endif
        </div>
    </div>
    <div class="card shadow mb-3">
        <div class="card-header"><strong class="text-primary">Ijazah (Scan Asli)</strong>
        </div>
        <div class="card-body">
            <div class="position-relative text-center">
                @if ($ijazah)
                    <img src="{{ $ijazah->temporaryUrl() }}" class="img-thumbnail rounded mx-auto d-block" style="max-height: 500px" alt="ijazah">
                @elseif ($ijazah_image)
                    <img src="{{url('/ijazah/'.$ijazah_image)}}" class="img-thumbnail rounded mx-auto d-block" style="max-height: 500px" alt="{{$ijazah_image}}">
                @else
                    <div wire:loading.remove>
                        <input wire:model="ijazah" accept="image/jpg, image/jpeg, image/png" type="file" class="form-control form-control-sm" id="inputGroupFile01i">
                    </div>
                @endif

                @error('ijazah') <span class="error text-danger">{{ $message }}</span> @enderror
                <div wire:loading.inline-flex wire:target="ijazah">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            @if($ijazah_image)
            <button wire:click="confirmHapusIjazah" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
            @elseif($ijazah)
            <button wire:click="uploadI" wire:loading.attr="disabled" class="btn btn-sm btn-outline-primary"  {{$ijazah?'':'disabled'}}><i class="bi bi-upload"></i> Upload </button>
            @endif
        </div>
    </div>
    <div class="card shadow mb-3">
        <div class="card-header"><strong class="text-primary">Transkip (Scan Asli)</strong>
        </div>
        <div class="card-body">
            <div class="position-relative text-center">
                @if ($transkip)
                    <img src="{{ $transkip->temporaryUrl() }}" class="img-thumbnail rounded mx-auto d-block" style="max-height: 500px" alt="transkip">
                @elseif ($transkip_image)
                    <img src="{{url('/transkip/'.$transkip_image)}}" class="img-thumbnail rounded mx-auto d-block" style="max-height: 500px" alt="{{$transkip_image}}">
                @else
                    <div wire:loading.remove>
                        <input wire:model="transkip" accept="image/jpg, image/jpeg, image/png" type="file" class="form-control form-control-sm">
                    </div>
                @endif

                @error('transkip') <span class="error text-danger">{{ $message }}</span> @enderror
                <div wire:loading.inline-flex wire:target="transkip">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            @if($transkip_image)
            <button wire:click="confirmHapusTranskip" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
            @elseif($transkip)
            <button wire:click="uploadT" wire:loading.attr="disabled" class="btn btn-sm btn-outline-primary"  {{$transkip?'':'disabled'}}><i class="bi bi-upload"></i> Upload </button>
            @endif
        </div>
    </div>

    <div class="card shadow mb-3">
        <div class="card-header"><strong class="text-primary">Tanda Tangan Ortu/Wali</strong>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 text-center">
                    @if($ortu_ttd_image)
                    <img src="{{url('/ortuttd/'.$ortu_ttd_image)}}" class="img-thumbnail rounded mx-auto d-block shadow" style="max-height: 500px" alt="{{$ortu_ttd_image}}">     
                    @else
                    <button wire:click="ttdOrtu" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTtd">
                        PAD Tanda Tangan Ortu/Wali
                      </button>
                      
                    @endif
                </div>
            </div>
        </div>
        @if($ortu_ttd_image)
        <div class="card-footer text-center">
            <button wire:click="clearTtd" id="clearTtd" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
        </div>
        @endif
    </div>

    <div class="card shadow mb-3">
        <div class="card-header"><strong class="text-primary">Tanda Tangan Maba</strong>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 text-center">
                    @if($ttd_image)
                    <img src="{{url('/ttd/'.$ttd_image)}}" class="img-thumbnail rounded mx-auto d-block shadow" style="max-height: 500px" alt="{{$ttd_image}}">     
                    @else
                    <button wire:click="ttdMaba" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTtd">
                        PAD Tanda Tangan Maba
                      </button>
                      
                    @endif
                </div>
            </div>
        </div>
        @if($ttd_image)
        <div class="card-footer text-center">
            <button wire:click="clearTtdMaba" id="clearTtdMaba" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
        </div>
        @endif
    </div>

    <!-- Modal MESSAGE-->
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content shadow ">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- @if($errors)
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="ms-2">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif --}}
                <p>{{$message}}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-sm btn-primary text-light" data-bs-dismiss="modal"><i class="bi bi-house"></i> OK </button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal TTD-->
    <div wire:ignore.self class="modal fade" id="staticBackdropTtd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelTtd" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabelTtd">Upload Tanda Tangan {{$isttdortu?'Ortu/Wali': 'Maba'}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:ignore  class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="wrapper">
                            <canvas id="signature-pad" class="signature-pad border shadow" width="100%" height=200></canvas>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col">
                    <small>*Buat tanda tangan didalam kotak diatas</small>
                </div>
            </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="clearTtdM" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Clear</button>
                <button wire:click="uploadTtd" id="saveTtd" class="btn btn-sm btn-outline-primary"  data-bs-dismiss="modal"><i class="bi bi-upload"></i> Upload </button>
            </div>
        </div>
        </div>
    </div>

</div>
@push('scriptsrel')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@endpush
@push('scripts')
<script>
    var sig;

    document.addEventListener("DOMContentLoaded", function(event) { 
        const myModalEl = document.getElementById('staticBackdrop')
        const myModal = new bootstrap.Modal(myModalEl);
        myModalEl.addEventListener('hidden.bs.modal', event => {
            console.log('hide modal');
        });
        Livewire.on('showMessage', (message) => {
            if(message) myModal.show();
            console.log(message);
        });
        Livewire.on('errorsInput', (errors) => {
            if(Object.keys(errors).length>0) myModal.show();
            console.log(errors);
        });
        Livewire.on('confirmhapusPhoto', () => {
            let result = confirm('Anda yakin akan menhapus Photo?');
            console.log('result', result);
            if(result) Livewire.emit('hapusPhoto');
        });
        Livewire.on('confirmhapusIjazah', () => {
            if(confirm('Ijazah akan di hapus?')){
                Livewire.emit('hapusIjazah');
            }
        });
        Livewire.on('confirmhapusTranskip', () => {
            if(confirm('Transkip akan di hapus?')){
                Livewire.emit('hapusTranskip');
            }
        });
        Livewire.on('clearCanvas', () => {
            signaturePad.clear();
        })
        
        const canvas = document.querySelector("canvas");
        var signaturePad;
        const myModalPad = document.getElementById('staticBackdropTtd');

        myModalPad.addEventListener('shown.bs.modal', event => {
            const canvas = document.querySelector("canvas");
            
            signaturePad = new SignaturePad(canvas);
            signaturePad.addEventListener("endStroke", (ttd) => {
                // console.log("Signature endStroke");
                if(!signaturePad.isEmpty()){
                    const data = signaturePad.toDataURL();
                    Livewire.emit('updateTtd', data);
                }
            }, { once: false }); 
            signaturePad.clear();
            if(sig) signaturePad.fromDataUrl(sig);

            const ttdm = document.getElementById('clearTtdM');
            ttdm.addEventListener('click', ()=>{
                signaturePad.clear();
            });

            resizeCanvas();
        });
 
        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        function resizeCanvas() {
            const ratio =  Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            if(signaturePad) signaturePad.clear(); // otherwise isEmpty() might return incorrect value
        }
        
        // function createSig(){
        //     signaturePad = new SignaturePad(canvas);
        //     signaturePad.addEventListener("endStroke", (ttd) => {
        //         console.log("Signature endStroke");
        //         if(!signaturePad.isEmpty()){
        //             const data = signaturePad.toDataURL();
        //             Livewire.emit('updateTtd', data);
        //         }
        //     }, { once: false }); 
        //     if(sig) signaturePad.fromDataUrl(sig);
        // }
        

        
 
        // function clearCanvasTtd(){
        //         if(signaturePad) signaturePad.clear();
        //         Livewire.emit('onClearTtd');
        //         // showCanvas();
        // }
        // function setCanvas(data){
        //     // process.nextTick( () => {
        //     //     signaturePad.fromDataUrl(data);
        //     // });
        //     // const canv = document.querySelector("canvas");
        //     // const sig = new SignaturePad(canv);
        //     // sig.fromDataUrl(data);
        // }
        // function showCanvas(){
        //     canvas.style.display = 'inline-block';
        // }
        // function hideCanvas(){
        //     canvas.style.display = 'none';
        // }
        // Livewire.on('showCanvas', () => {
        //     showCanvas();
        //     createSig();
            
        // });
        // Livewire.on('hideCanvas', () => {
        //     console.log('hid');
        //     hideCanvas();
        // });

        // Livewire.on('setTtd64', (data) => {
        //     // console.log('setTtd64 ', data);
        //     sig = data;
        //     // if(data) {
        //     //     setCanvas(data);
        //     //     hideCanvas();
        //     // }else{
        //     //     showCanvas();
        //     // }
        // });
        

    });
    
</script>
@endpush