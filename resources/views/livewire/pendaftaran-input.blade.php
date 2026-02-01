<div class="container">
    <div class="row mb-2">
        <div class="col text-center" >
            <img src="{{url('/logo')}}" style="width: 120px;" alt="StikesPIK">
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="steps">
            <progress id="progress"  value=0 max=100 ></progress>
            <div class="step-item">
                <button class="step-button text-center" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="{{$tab1}}" aria-controls="collapseOne" >
                    {{-- <strong>1</strong> --}}
                    <i class="bi bi-1-circle" style="font-size: 2rem; vertical-align: middle"></i>
                </button>
                <div class="step-title">
                    <strong>Biodata</strong>
                </div>
            </div>
            <div class="step-item">
                <button {{$this->step1Valid()? '' : ' disabled '}} class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="{{$tab2}}" aria-controls="collapseTwo" >
                    {{-- <strong>2</strong> --}}
                    <i class="bi bi-2-circle" style="font-size: 2rem; vertical-align: middle"></i>
                </button>
                <div class="step-title">
                    <strong>Pilihan</strong>
                </div>
            </div>
            <div class="step-item">
                <button {{$this->step2Valid()? '' : ' disabled '}} class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="{{$tab3}}" aria-controls="collapseThree" >
                    {{-- <strong>3</strong> --}}
                    <i class="bi bi-3-circle" style="font-size: 2rem; vertical-align: middle"></i>
                </button>
                <div class="step-title">
                    <strong>Ortu/Wali</strong>
                </div>
            </div>
        </div>
        <div id="collapseOne" class="collapse {{$tab1=='true'?'show':''}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="card shadow border-primary">
                <h5 class="card-header bg-primary text-light">Biodata @if($idp>0) <span class="float-end"><i class="bi bi-pencil"></i></span>@endif</h5>
                <div class="card-body">
                    @if($idp>0)
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >NO. PENDAFTARAN</label>
                        <div class="col-sm-10 "><h5><span class="badge bg-success text-light">{{$no_daftar}}</span></h5>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >NISN</label>
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control form-control-sm {{!$nisn || $nisn_exists ? 'is-invalid' : 'is-valid'}}" wire:model="nisn" id="colFormLabelSm" placeholder="Nomor Induk Siswa Nasional" required>
                            @if($nisn_exists)
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <small>NISN Sudah Terdaftar</small>
                              </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSmnik" class="col-sm-2 col-form-label col-form-label-sm" >NIK</label>
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control form-control-sm " wire:model="nik" id="colFormLabelSmnik" placeholder="Nomor Induk Kependudukan" >
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">NAMA LENGKAP</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm {{!$nama_depan ? 'is-invalid' : 'is-valid'}}" wire:model="nama_depan" id="colFormLabelSmd" placeholder="Nama depan" required>
                                <input type="text" class="form-control form-control-sm" wire:model="nama_belakang" id="colFormLabelSmb" placeholder="Nama belakang">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm ">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  {{!$jenis_kelamin ? 'is-invalid' : 'is-valid'}}" wire:model="jenis_kelamin" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="L">
                                <label class="form-check-label " for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  {{!$jenis_kelamin ? 'is-invalid' : 'is-valid'}}" wire:model="jenis_kelamin" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="P">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tempat Lahir & Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                            <input required wire:model="tempat_lahir" type="text" class="form-control form-control-sm {{!$tempat_lahir ? 'is-invalid' : 'is-valid'}}" placeholder="Tempat lahir" aria-label="tempat_lahir" aria-describedby="basic-addon1">
                            <input required wire:model="tanggal_lahir" type="date" class="form-control form-control-sm {{!$tanggal_lahir ? 'is-invalid' : 'is-valid'}}" placeholder="Tanggal Lahir" aria-label="tanggal_lahir" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Agama</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-sm mb-2">
                                <select required wire:model="agama_id" class="form-select form-select-sm {{!$agama_id ? 'is-invalid' : 'is-valid'}}" aria-label="agama_id">
                                    <option value="" selected>--Agama--</option>
                                    @foreach ($agama as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>

                                <span style="width: 100px"class="input-group-text"  id="inputGroup-sizing-default" for="exampleDataListw">Warganegara</span>
                                <input style="max-width: 120px; width: 120px" list="datalistOptions_w"  wire:model="warganegara" type="text" class="form-control form-control-sm"  placeholder="cth: INDONESIA" aria-label="warganegara" aria-describedby="basic-addon1w">
                                <datalist id="datalistOptions_w">
                                    <option value="INDONESIA">
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm mb-2" id="exampleFormControlTextarea1" wire:model.defer="alamat" placeholder="Alamat tempat tinggal" rows="2"></textarea>
                            <div class="input-group input-group-sm mb-2">
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListp">Provinsi</span>
                                <select wire:model="provinsi_id" class="form-select form-select-sm" id="provinsi_id" aria-label="provinsi_id" required>
                                    <option value="" selected>--Provinsi--</option>
                                    @foreach ($provinsi as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListk">Kab/Kota</span>
                                <select wire:model="kabkota_id" class="form-select form-select-sm" id="kabkota_id" aria-label="kabkota_id" required>
                                    <option value="" selected>--Kab/Kota--</option>
                                    @foreach ($kabkota as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListp">Kodepos</span>
                                <input style="max-width: 100px" wire:model="kodepos" type="text" class="form-control form-control-sm" maxlength="5" placeholder="cth: 93111" aria-label="kodepos" aria-describedby="basic-addon1kp">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListpk">Kecamatan</span>
                                <select wire:model="kecamatan_id" class="form-select form-select-sm" id="kecamatan_id" aria-label="kecamatan_id" required>
                                    <option value="" selected>--Kecamatan--</option>
                                    @foreach ($kecamatan as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListkl">Kelurahan</span>
                                <select wire:model="kelurahan_id" class="form-select form-select-sm" id="keluarahan_id" aria-label="keluarahan_id" required>
                                    <option value="" selected>--Kelurahan--</option>
                                    @foreach ($kelurahan as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListpkrt">RT</span>
                                <input style="max-width: 100px" wire:model="rt" type="text" class="form-control form-control-sm" maxlength="3" placeholder="cth: 001" aria-label="rt" aria-describedby="basic-addon1kprt">
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListpkrw">RW</span>
                                <input style="max-width: 100px" wire:model="rw" type="text" class="form-control form-control-sm" maxlength="3" placeholder="cth: 001" aria-label="rw" aria-describedby="basic-addon1kprw">
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListpkds">Dusun</span>
                                <input wire:model="dusun" type="text" class="form-control form-control-sm"  placeholder="Nama dusun" aria-label="dusun" aria-describedby="basic-addon1kpds">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span  class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListkljt">Jenis Tinggal</span>
                                <select wire:model="jenis_tinggal_id" class="form-select form-select-sm" id="jenis_tinggal_id" aria-label="jenis_tinggal_id" required>
                                    <option value="" selected>--Jenis--</option>
                                    @foreach ($jenis_tinggal as $val)
                                    <option value="{{$val->id}}">{{$val->keterangan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row mb-2">
                        <label for="colFormLabelSmt" class="col-sm-2 col-form-label col-form-label-sm">Nomor HP./WA.</label>
                        <div class="col-sm-10">
                            <input required wire:model="hp" type="text" class="form-control form-control-sm  {{!$hp ? 'is-invalid' : 'is-valid'}}" id="colFormLabelSmt" placeholder="cth: 085241667856">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSme" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                        <div class="col-sm-10">
                            <input required wire:model="email" type="email" class="form-control form-control-sm  {{!$email ? 'is-invalid' : 'is-valid'}}" id="colFormLabelSme" placeholder="cth: nama_aku@email.com">
                        </div>
                    </div>          
                    
                </div>
                <div class="card-footer text-end">
                    <span class="float-start"><a href="{{url('/pendaftaran')}}" class="btn btn-secondary btn-sm"><i class="bi bi-x-lg"></i> BATAL</a></span>
                    <button {{$this->step1Valid()? '' : 'disabled'}} id="berikut1" class="btn btn-sm btn-info" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" 
                            aria-expanded="false" aria-controls="collapseTwo"><i class="bi bi-arrow-right"></i> SELANJUTNYA</button>
                </div>
            </div>
        </div>


        <div id="collapseTwo" class="collapse {{$tab2=='true'?'show':''}}" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="card shadow border-primary">
                <h5 class="card-header bg-primary text-light">Asal Sekolah/PT & Pilihan Jurusan</h5>

                <div class="card-body">
                    <div class="row mb-2">
                        <label for="colFormLabelSmjd" class="col-sm-2 col-form-label col-form-label-sm ">Jenis Daftar</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  " wire:model="jenis_daftar" type="radio" name="inlineRadioOptionsjd" id="inlineRadio1jd" value="0">
                                <label class="form-check-label " for="inlineRadio1jd">Lulusan SMA/MA Sederajat</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " wire:model="jenis_daftar" type="radio" name="inlineRadioOptionsjd" id="inlineRadio2jd" value="1">
                                <label class="form-check-label" for="inlineRadio2jd">Alih Jenjang</label>
                            </div>
                        </div>
                    </div>

                    @if($jenis_daftar==1)
                    <div class="row mb-1">
                        <label for="colFormLabelSmkpt" class="col-sm-2 col-form-label col-form-label-sm" >Kode PT Asal</label>
                        <div class="col-sm-10 ">
                            <div class="input-group input-group-sm">
                                <input style="max-width: 100px" type="text" class="form-control form-control-sm " wire:model.defer="kode_pt_asal" id="colFormLabelSmkpt" placeholder="Kode PT asal">
                                <span  class="input-group-text" for="colFormLabelSmnpt">Nama PT Asal</span>
                                <input wire:model.defer="nama_pt_asal" type="text" class="form-control form-control-sm " id="colFormLabelSmnpt" placeholder="Nama perguruan tinggi asal" aria-label="nama_pt_asal" aria-describedby="basic-colFormLabelSmnpt">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colFormLabelSmkps" class="col-sm-2 col-form-label col-form-label-sm" >Kode PS Asal</label>
                        <div class="col-sm-10 ">
                            <div class="input-group input-group-sm">
                                <input style="max-width: 100px" type="text" class="form-control form-control-sm " wire:model.defer="kode_ps_asal" id="colFormLabelSmkps" placeholder="Kode PS asal">
                                <span  class="input-group-text" for="colFormLabelSmnpt">Nama PS Asal</span>
                                <input wire:model.defer="nama_ps_asal" type="text" class="form-control form-control-sm " id="colFormLabelSmnps" placeholder="Nama program studi asal" aria-label="nama_pt_asal" aria-describedby="basic-colFormLabelSmnps">
                            </div>
                        </div>
                    </div>
                    @else

                    <div class="row mb-1">
                        <label for="colFormLabelSmns" class="col-sm-2 col-form-label col-form-label-sm" >Nama Asal Sekolah</label>
                        <div class="col-sm-10 ">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm  {{!$asal_sekolah ? 'is-invalid' : 'is-valid'}}" wire:model.lazy="asal_sekolah" id="colFormLabelSmns" placeholder="Nama asal sekolah" required>
                                <span style="width: 85px" class="input-group-text"  for="exampleDataListp">Tahun Lulus</span>
                                <input style="max-width: 100px" wire:model="tahun_lulus" type="text" id="exampleDataListp" class="form-control form-control-sm  {{!$tahun_lulus ? 'is-invalid' : 'is-valid'}}" maxlength="4" placeholder="XXXX" aria-label="tahun_lulus" aria-describedby="basic-addon1tl">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm_npsn" class="col-sm-2 col-form-label col-form-label-sm" >NPSN Asal Sekolah</label>
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control form-control-sm  {{!$asal_sekolah_npsn ? 'is-invalid' : 'is-valid'}}" wire:model.lazy="asal_sekolah_npsn" id="colFormLabelSm_npsn" placeholder="Nomor Pokok Sekolah Nasional asal sekolah" required>
                        </div>
                    </div>

                    @endif
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Pilihan Jurusan</label>
                        <div class="col-sm-10 ">
                            <div class="input-group mb-1 input-group-sm">
                                <span class="input-group-text" id="basic-addon1-p1">Pilihan 1</span>
                                <select @if($status_jadwal>0) disabled @endif wire:model="jurusan_id" class="form-select form-select-sm {{!$jurusan_id ? 'is-invalid' : 'is-valid'}}" aria-label="jurusan_id" required aria-describedby="basic-addon1-p1">
                                    <option value="" selected>--Pilihan 1--</option>
                                    @foreach ($jurusan as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-1 input-group-sm">
                                <span class="input-group-text" id="basic-addon1-p2">Pilihan 2</span>
                                <select @if(!$jurusan_id>0 || $status_jadwal>0) disabled @endif wire:model="jurusan_id2" class="form-select form-select-sm" aria-label="jurusan_id2" required aria-describedby="basic-addon1-p2">
                                    <option value="" selected>--Pilihan 2--</option>
                                    @foreach ($jurusan2 as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-1 input-group-sm">
                                <span class="input-group-text" id="basic-addon1-p3">Pilihan 3</span>
                                <select @if(!$jurusan_id2>0 || $status_jadwal>0) disabled @endif wire:model="jurusan_id3" class="form-select form-select-sm" aria-label="jurusan_id3" required aria-describedby="basic-addon1-p3">
                                    <option value="" selected>--Pilihan 3--</option>
                                    @foreach ($jurusan3 as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>

                    
                </div>
                <div class="card-footer text-end">
                    <span class="float-start"><a href="{{url('/pendaftaran')}}" class="btn btn-secondary btn-sm"><i class="bi bi-x-lg"></i> BATAL</a></span>
                    <button id="sebelum1" class="btn btn-sm btn-info" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="bi bi-arrow-left"></i> SEBELUMNYA</button>

                    <button {{$this->step2Valid()? '' : 'disabled'}} id="berikut2" class="btn btn-sm btn-info" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#collapseThree" 
                            aria-expanded="false" aria-controls="collapseThree"><i class="bi bi-arrow-right"></i> SELANJUTNYA</button>
                </div>
            </div>
        </div>


        <div id="collapseThree" class="collapse {{$tab3=='true'?'show':''}}" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="card shadow border-primary">
                <h5 class="card-header bg-primary text-light">Ortu/Wali</h5>
                <div class="card-body">
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">NAMA LENGKAP</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm {{!$ortu_nama_depan ? 'is-invalid' : 'is-valid'}}" wire:model.lazy="ortu_nama_depan" id="colFormLabelSmd" placeholder="Nama depan" required>
                                <input type="text" class="form-control form-control-sm" wire:model.defer="ortu_nama_belakang" id="colFormLabelSmb" placeholder="Nama belakang">
                            </div>
                            
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSmojk" class="col-sm-2 col-form-label col-form-label-sm ">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input  {{!$ortu_jenis_kelamin ? 'is-invalid' : 'is-valid'}}" wire:model="ortu_jenis_kelamin" type="radio" name="inlineRadioOptionso" id="inlineRadio1o" value="L">
                                <label class="form-check-label " for="inlineRadio1o">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input  {{!$ortu_jenis_kelamin ? 'is-invalid' : 'is-valid'}}" wire:model="ortu_jenis_kelamin" type="radio" name="inlineRadioOptionso" id="inlineRadio2o" value="P">
                                <label class="form-check-label" for="inlineRadio2o">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tempat Lahir & Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                            <input wire:model.defer="ortu_tempat_lahir" type="text" class="form-control form-control-sm" placeholder="Tempat lahir" aria-label="tempat_lahir" aria-describedby="basic-addon1">
                            <input wire:model.defer="ortu_tanggal_lahir" type="date" class="form-control form-control-sm" placeholder="Tanggal Lahir" aria-label="tanggal_lahir" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Agama</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-sm mb-2">
                                <select required wire:model="ortu_agama_id" class="form-select form-select-sm {{!$ortu_agama_id ? 'is-invalid' : 'is-valid'}}" aria-label="agama_id">
                                    <option value="" selected>--Agama--</option>
                                    @foreach ($agama as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                                <span style="width: 100px"class="input-group-text"  id="inputGroup-sizing-default" for="exampleDataListw">Warganegara</span>
                                <input style="max-width: 120px; width: 120px" list="datalistOptions_w"  wire:model.defer="ortu_warganegara" type="text" class="form-control form-control-sm"  placeholder="cth: INDONESIA" aria-label="warganegara" aria-describedby="basic-addon1w">
                                <datalist id="datalistOptions_w">
                                    <option value="INDONESIA">
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm mb-2" id="exampleFormControlTextarea1" wire:model.defer="ortu_alamat" placeholder="Alamat tempat tinggal" rows="2"></textarea>
                            <div class="input-group input-group-sm mb-2">
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListpo">Provinsi</span>
                                <select wire:model="ortu_provinsi_id" class="form-select form-select-sm " id="ortu_provinsi_id" aria-label="ortu_provinsi_id">
                                    <option value="" selected>--Provinsi--</option>
                                    @foreach ($provinsio as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListko">Kab/Kota</span>
                                <select wire:model="ortu_kabkota_id" class="form-select form-select-sm" id="ortu_kabkota_id" aria-label="ortu_kabkota_id" >
                                    <option value="" selected>--Kab/Kota--</option>
                                    @foreach ($kabkotao as $val)
                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                                <span style="width: 80px" class="input-group-text" id="inputGroup-sizing-default" for="exampleDataListkpo">Kodepos</span>
                                <input style="max-width: 100px" wire:model.defer="ortu_kodepos" type="text" class="form-control form-control-sm" maxlength="5" placeholder="cth: 93111" aria-label="ortu_kodepos" aria-describedby="basic-addon1kp">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Hubungan Keluarga</label>
                        <div class="col-sm-10">
                            <input wire:model.defer="ortu_hubungan" type="text" class="form-control form-control-sm" placeholder="cth: ANAK KANDUNG" aria-label="ortu_hubungan" aria-describedby="basic-addonhub">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Pekerjaan</label>
                        <div class="col-sm-10">
                            <input wire:model.defer="ortu_pekerjaan" type="text" class="form-control form-control-sm" placeholder="cth: PETANI" aria-label="ortu_pekerjaan" aria-describedby="basic-addonpekerjaan">
                        </div>
                    </div>
                    <div class="row mb-2 mt-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Menyetujui</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" wire:model="setuju" id="flexCheckCheckeds">
                                <label class="form-check-label" for="flexCheckCheckeds"><strong>Data tersebut diatas adalah BENAR, Saya akan menanggung RESIKO apabila data diatas adalah SALAH</strong></label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <span class="float-start"><a href="{{url('/pendaftaran')}}" class="btn btn-secondary btn-sm"><i class="bi bi-x-lg"></i> TUTUP</a></span>
                    <div class="btn-group btn-group-sm" >
                        <button id="sebelum2" class="btn btn-info" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="bi bi-arrow-left"></i> SEBELUMNYA</button>
                        <button {{$this->allStepValid()? '' : 'disabled'}} class="btn btn-primary text-light" wire:click="save" wire:loading.attr="disabled"><i class="bi bi-upload"></i> SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content bg-danger text-light shadow">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Error</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li class="ms-2">{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            <div class="modal-footer justify-content-center">
                
                <button wire:click="clearErrorBag" type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal"><i class="bi bi-arrow-return-left"></i> OK</button>
                
            </div>
        </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        const stepButtons = document.querySelectorAll('.step-button');
        const progress = document.querySelector('#progress');
        var idx = 0;
        var btns = [];
        Array.from(stepButtons).forEach((button, index) => {
            button.addEventListener('click', () => buttonClick(button, index));
            btns.push(button);
        });
        
        function buttonClick(button, index){
            console.log('button status:', button.disabled);
            if(!button.disabled){
                    idx = index;
                    progress.setAttribute('value', index * 100 /(stepButtons.length - 1) );//there are 3 buttons. 2 spaces.
                    stepButtons.forEach((item, secindex)=>{
                        if(index > secindex){
                            item.classList.add('done');
                        }
                        if(index < secindex){
                            item.classList.remove('done');
                        }
                    });
                    
                    // button.disabled = true;
                }
                console.log("INDEX:",index);
        }

        const berikut1 = document.getElementById('berikut1');
        berikut1.addEventListener('click', ()=> buttonClick(berikut1, 1));
        const berikut2 = document.getElementById('berikut2');
        berikut2.addEventListener('click', ()=> buttonClick(berikut2, 2));
        const sebelum1 = document.getElementById('sebelum1');
        sebelum1.addEventListener('click', ()=> buttonClick(sebelum1, 0));
        const sebelum2 = document.getElementById('sebelum2');
        sebelum2.addEventListener('click', ()=> buttonClick(sebelum2, 1));
        Livewire.on('updatedStep', (index) => {
            buttonClick(btns[index], index);
            console.log('RUN UPDATE STEP INDEX', index, btns[index])
        });

        const myModalEl = document.getElementById('staticBackdrop')
        const myModal = new bootstrap.Modal(myModalEl);
        myModalEl.addEventListener('hidden.bs.modal', event => {
            console.log('hide modal');
        });
        Livewire.on('errorsInput', (errors) => {
            if(Object.keys(errors).length>0) myModal.show();
            console.log(errors);
        });
    });
</script>
@endpush