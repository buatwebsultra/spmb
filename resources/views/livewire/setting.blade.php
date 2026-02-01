<div class="container">
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    <div class="card shadow border-success mb-3">
        <div class="card-header">
            <span class="float-end">
                <button class="btn btn-sm btn-outline-primary" wire:click="save">Update</button>
            </span>
            Aplikasi

        </div>
        <div class="card-body m-2 mb-3 p-3 border shadow">
            <h3 class="card-title">Selamat Datang</h3>
            <div wire:ignore class="mb-1">
                <input type="text"  id="head_welcome" name="head_welcome"  wire:model="head_welcome" class="form-control form-control-sm mb-2" id="exampleFormControlTextarea1head_welcome" placeholder="Judul selamat datang..." >
            </div>
            <div wire:ignore class="mb-3">
                <textarea  id="selamat_datang" name="selamat_datang"  wire:model="selamat_datang" class="form-control form-control-sm mb-2" id="exampleFormControlTextarea1" placeholder="Isi selamat datang ketik disini..." rows="2"></textarea>
            </div>
            <h3 class="card-title">Nama Perguruan Tinggi</h3>
            <input wire:model="instansi"  type="text" class="form-control mb-3" aria-label="instansi" aria-describedby="instansi">
            
            
            <h3 class="card-title">Contact Person</h3>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1nm">Nama</span>
                <input wire:model="kontak_nama"  type="text" class="form-control" aria-label="kontak_nama" aria-describedby="kontak_nama">
                <span class="input-group-text" id="basic-addon1hp">HP./WA.</span>
                <input wire:model="kontak_hp"  type="text" class="form-control" aria-label="kontak_hp" aria-describedby="kontak_hp">
              </div>
            <h3 class="card-title">Logo</h3>
            <div class="mb-3">
                
                    @if ($logo)
                        <img class="img-fluid" src="{{ $logo->temporaryUrl() }}">
                    @else
                        @if($logo_app)
                        <img class="img-fluid" src="{{ url('/logo') }}">
                        @endif
                    @endif
                    <br>
                    <input type="file" class="form-control mt-2" wire:model="logo">
                
                    @error('logo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <h3>Background Header</h3>
            <div class="mb-3">
                @if ($photo)
                    <img class="img-fluid" src="{{ $photo->temporaryUrl() }}">
                @else
                    @if($bg_head)
                    <img class="img-fluid" src="{{ url('/bghead') }}">
                    @endif
                @endif
            
                <input type="file" class="form-control mt-2" wire:model="photo">
            
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            <h3 class="card-title">Informasi</h3>
            <div wire:ignore  class="mb-4 bg-secondary-subtle p-3">
                <textarea  id="informasi" name="informasi"  wire:model.defer="informasi" class="ckeditor form-control form-control-sm mb-2" id="exampleFormControlTextarea1informasi" placeholder="Isi/Deskripsi informasi ketik disini..." rows="4"></textarea>
            </div>
            <h3 class="card-title" >Profil</h3>
            <div wire:ignore  class="mb-4 bg-secondary-subtle p-3">
                <textarea  id="profil" name="profil"  wire:model="profil" class="ckeditor form-control form-control-sm mb-2" id="exampleFormControlTextarea1profil" placeholder="Isi/Deskripsi profil ketik disini..." rows="4"></textarea>
            </div>
        </div>
        <div class="card-body m-2 mb-3 p-3 border shadow">
            <h3>Durasi Pendaftaran</h3>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm1">Tanggal Pendaftaran</span>
                <input wire:model="buka_pendaftaran"  type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm1">
                <span class="input-group-text" id="inputGroup-sizing-sm2">Sampai dengan</span>
                <input wire:model="tutup_pendaftaran" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm2">
                <span class="input-group-text" id="inputGroup-sizing-sm3">Tahun Akademik</span>
                <input wire:model="ta_pendaftaran" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm3">
            </div>
            <h3>Biaya</h3>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm4">Biaya Pendaftaran</span>
                <input wire:model="biaya_pendaftaran" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm4">
                <span class="input-group-text" id="inputGroup-sizing-sm5">Biaya SPP</span>
                <input wire:model="biaya_spp" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm5">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm4x">Biaya Peningkatan Pendidikan</span>
                <input wire:model="biaya_pendidikan" type="number" class="form-control" aria-label="Sizing example input4x" aria-describedby="inputGroup-sizing-sm4x">
                <span class="input-group-text" id="inputGroup-sizing-sm5x">Biaya Almamater</span>
                <input wire:model="biaya_almamater" type="number" class="form-control" aria-label="Sizing example input5x" aria-describedby="inputGroup-sizing-sm5x">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm4y">Biaya Lain</span>
                <input wire:model="biaya_lain" type="number" class="form-control" aria-label="Sizing example inputy" aria-describedby="inputGroup-sizing-sm4y">
            </div>
            <h3>Rekening</h3>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm6">Nama Rekening</span>
                <input wire:model="nama_rekening" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm6">
                <span class="input-group-text" id="inputGroup-sizing-sm7">Nomor Rekening</span>
                <input wire:model="nomor_rekening" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm7">
                <span  class="input-group-text" id="inputGroup-sizing-sm8">Nama Bank</span>
                <input wire:model="nama_bank" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm8">
            </div>
            <h3>Durasi Daftar Ulang</h3>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm9">Tanggal Mulai</span>
                <input wire:model="daftar_ulang_awal" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm9">
                <span class="input-group-text" id="inputGroup-sizing-sm10">Tanggal Berakhir</span>
                <input wire:model="daftar_ulang_akhir"  type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm10">
            </div>
            <h3 class="card-title">Link Persyaratan Daftar Ulang</h3>
            <input wire:model="link_syarat_daftar_ulang"  type="text" class="form-control" aria-label="link_syarat_daftar_ulang" aria-describedby="link_syarat_daftar_ulang">
            <div class="float-end mt-3">
                <button class="btn btn-sm btn-outline-primary" wire:click="save">Update</button>
            </div>
        </div>
        
    </div>
    
</div>
@push('scriptsrel')
{{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
@endpush
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            ClassicEditor
            .create(document.querySelector('#informasi'), {
                ckfinder: {
                    uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('informasi', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#profil'), {
                ckfinder: {
                    uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('profil', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
            
        });
        
    </script>
@endpush