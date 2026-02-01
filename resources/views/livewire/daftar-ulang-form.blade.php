<div class="container">
    @error('nama_ayah')
        <div class="alert alert-danger mb-2">
            {{ $message }}
        </div>
    @enderror
    @error('nama_ibu')
        <div class="alert alert-danger mb-2">
            {{ $message }}
        </div>
    @enderror
    <div class="card shadow border-primary">
        <div class="card-header bg-primary text-light">
            <h5 class="mb-0">Daftar Ulang</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >NO. PENDAFTARAN</label>
                <div class="col-sm-10 ">
                    <h5 class="mb-0"><span class="badge bg-success text-light">{{$data->no_daftar}}</span></h5>
                </div>
            </div>
            <div class="row mb-3">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >JURUSAN</label>
                <div class="col-sm-10 ">
                    <h5 class="mb-0"><span class="badge bg-success text-light">{{$data->jurusan}}</span></h5>
                </div>
            </div>

            <h5 class="border-bottom border-2">Input Data Tambahan</h5>

            <div class="row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >AYAH</label>
                <div class="col-sm-10 ">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon1">Nama</span>
                        <input required wire:model="nama_ayah" type="text" class="form-control {{!$nama_ayah ? 'is-invalid' : 'is-valid'}}" placeholder="Nama lengkap ayah" aria-label="nama_ayah" aria-describedby="basic-addon1">
                        <span class="input-group-text" id="basic-addon1nik">NIK</span>
                        <input wire:model="nik_ayah" type="text" class="form-control" placeholder="NIK ayah" aria-label="nik_ayah" aria-describedby="basic-addon1nik">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addontgl">Tgl. Lahir</span>
                        <input wire:model="tgl_lahir_ayah" type="date" class="form-control" placeholder="tgl_lahir_ayah" aria-label="tgl_lahir_ayah" aria-describedby="basic-addon1tgl">
                        <span class="input-group-text" id="basic-addon1pekerjaan">Pekerjaan</span>
                        <input wire:model="pekerjaan_ayah" type="text" class="form-control" placeholder="Pekerjaan ayah" aria-label="pekerjaan_ayah" aria-describedby="basic-addon1pekerjaan">
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >IBU</label>
                <div class="col-sm-10 ">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon1ibu">Nama</span>
                        <input required wire:model="nama_ibu" type="text" class="form-control {{!$nama_ibu ? 'is-invalid' : 'is-valid'}}" placeholder="Nama lengkap ibu" aria-label="nama_ibu" aria-describedby="basic-addon1ibu">
                        <span class="input-group-text" id="basic-addon1nikibu">NIK</span>
                        <input wire:model="nik_ibu" type="text" class="form-control" placeholder="NIK ibu" aria-label="nik_ibu" aria-describedby="basic-addon1nikibu">
                    </div>
                </div>
            </div>

            <div class="row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Informasi</label>
                <div class="col-10">
                    <p>Proses Daftar Ulang akan menerbitkan <strong>NIM (Nomor Induk Mahasiswa)</strong> dan <strong>Invoice Biaya Masuk</strong> dengan rincian sebagai berikut:</p>
                    <dl class="row ms-2" style="max-width: 25rem;">
                        <dd class="col-sm-8 mb-0">SPP</dd>
                        <dt class="col-sm-4 mb-0 text-end">Rp. {{number_format($setting['biaya_spp'], 0, ',', '.');}}</dt>
                        <dd class="col-sm-8 mb-0">Dana Peningkatan Pendidikan</dd>
                        <dt class="col-sm-4 mb-0  text-end">Rp. {{number_format($setting['biaya_pendidikan'], 0, ',', '.');}}</dt>
                        <dd class="col-sm-8 mb-0">Dana Almamater</dd>
                        <dt class="col-sm-4 mb-0  text-end">Rp. {{number_format($setting['biaya_almamater'], 0, ',', '.');}}</dt>
                        <dd class="col-sm-8 mb-0">Dana Lain</dd>
                        <dt class="col-sm-4 mb-0  text-end">Rp. {{number_format($setting['biaya_lain'], 0, ',', '.');}}</dt>
                        <dd class="col-sm-8 mb-0 border-top border-2"><strong>Jumlah</strong></dd>
                        <dt class="col-sm-4 mb-0  text-end border-top"><strong>Rp. {{number_format($biaya , 0, ',', '.');}}</strong></dt>
                    </dl>
                </div>
            </div>

            <div class="row mb-2 mt-3">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Persetujuan</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" wire:model="setuju" id="flexCheckCheckeds">
                        <label wire:model="setuju" class="form-check-label" for="flexCheckCheckeds">Saya menyutujui daftar ulang untuk sebagai mahasiswa jurusan <strong>{{$data->jurusan}}</strong> tahun <strong>{{$data->ta_pendaftaran}}</strong></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button wire:click="save" @if(!$setuju > 0) disabled @endif class="btn btn-sm btn-outline-primary"><i class="bi bi-upload"></i> Daftar</button>
        </div>
    </div>
</div>
