<div class="container container-fluid">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
      @endif
    <div class="accordion mb-3 shadow" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingFour">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
              <div class="d-flex flex-fill">
                  <span class="flex-fill"><strong>Info Akun User</strong></span>
                  {{-- <h5 class="mb-0 me-3"><span class="badge text-bg-success">{{$data['no_daftar']}}</span></h3> --}}
              </div>  
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
          <div class="accordion-body">
              @include('livewire.pendaftaran-info-akun', ['data' => $data])
          </div>
        </div>
      </div>
      @if($data)
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
          <div class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
              <div class="d-flex flex-fill">
                  <span class="flex-fill  align-self-center"><strong>Form Pendaftaran</strong></span>
                  {{-- @if($data['status_spp']==null) --}}
                  {{-- @if($data['status_bayar']==null) --}}
                  
                  <h5 wire:click="edit" class="mb-0 me-1 btn btn-sm btn-outline-success"><i class="bi bi-pencil"></i> Edit</h5>
                  <h5 wire:click="upload" class="mb-0 me-1 btn btn-sm btn-outline-success"><i class="bi bi-upload"></i> Upload</h5>
                  {{-- @endif --}}
                  {{-- <h5 wire:click="cetak" class="mb-0 me-3 btn btn-sm btn-outline-success">
                    <div wire:loading wire:target="cetak" class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <i class="bi bi-printer"></i> Cetak
                  </h5> --}}
                  <a href="{{url('/cetak/form/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a>
                  {{-- @endif --}}
              </div>  
              
            </div>
          
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
          <div class="accordion-body">
              <div id='printable_div_id'>
                @include('livewire.pendaftaran-data-form', ['data' => $data])
              </div>
          </div>
        </div>
      </div>
    
      <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                <div class="d-flex flex-fill">
                    <span class="flex-fill  align-self-center"><strong>Invoice Pendaftaran</strong></span>
                    @if($data['status_bayar']>0)
                    <h5 class="mb-0 me-3"><span class="badge bg-success text-light">LUNAS</span></h5>
                    @else
                    {{-- <a href="{{url('/cetak/invoice-daftar/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a> --}}
                    @endif
                    <a href="{{url('/cetak/invoice-daftar/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a>
                </div>  
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
                @include('livewire.pendaftaran-invoice', ['data' => $data])
            </div>
          </div>
      </div>
      @if($data['status_bayar']>0)
      <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                <div class="d-flex flex-fill">
                    <span class="flex-fill align-self-center"><strong>Kartu Ujian</strong></span>
                    @if($data['status_bayar']>0 && $data['status_lulus']==null && $data['status_jadwal']>0)
                      {{-- <a href="{{url('/cetak/kartu-ujian/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a> --}}
                    @endif
                    <a href="{{url('/cetak/kartu-ujian/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a>
                </div>  
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
              @if($data['status_bayar']>0)
                @if($data['status_jadwal']>0)
                  @include('livewire.pendaftaran-kartu-ujian', ['data' => $data])
                @else
                <h5 class="text-primary">Jadwal Ujian Masuk Sementara Proses</h5>
                @endif
              @else
                <h5 class="text-danger">Silahkan lakukan pembayaran biaya pendaftaran</h5>
              @endif
            </div>
          </div>
      </div>
      @endif
      @if($data['status_jadwal']>0)
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingSix">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
              <div class="d-flex flex-fill">
                  <span class="flex-fill align-self-center"><strong>Pengumuman Hasil Ujian</strong></span>
                  @if($data['status_seleksi']!=null)
                    <h5 class="mb-0 me-3"><span class="badge bg-success text-light">{{$data['status_seleksi']}}</span></h5>
                  @endif
              </div>  
          </button>
        </h2>
        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">
          <div class="accordion-body">
            @if($data['status_lulus']==null)
              <h5 class="text-danger">Belum Ada Hasil Pengumuman</h5>
            @else
            @include('livewire.pendaftaran-pengumuman', ['data' => $data])
            @endif
          </div>
        </div>
      </div>
      @endif

      @if($data['status_seleksi']=='LULUS')
      <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingFive">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                <div class="d-flex flex-fill">
                    <span class="flex-fill align-self-center"><strong>Invoice SPP Pertama</strong></span>
                    @if($data['status_daftar_ulang']>0)
                      @if($data['status_spp']>0)
                        <h5 class="mb-0 me-3"><span class="badge bg-success text-light">LUNAS</span></h5>
                      @elseif($data['status_lulus']>0 && $data['status_spp']==null)
                      {{-- <h5 class="mb-0 me-3 btn btn-sm btn-outline-primary"><i class="bi bi-printer"></i> Cetak</h5> --}}
                      {{-- <a href="{{url('/cetak/invoice-spp/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a> --}}
                      @endif
                      <a href="{{url('/cetak/invoice-spp/'.$data['id'])}}" target="blank" class="mb-0 me-3 btn btn-sm btn-outline-success d-flex align-items-center"><i class="bi bi-printer"></i></a>
                    @endif
                </div>  
            </button>
          </h2>
          <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
            <div class="accordion-body">

              @if($data['status_lulus']==null)
                <h5 class="text-danger">Belum Ada Pengumuman Hasil Ujian Masuk</h5>
              @else
                @if($data['status_daftar_ulang']>0)
                  @include('livewire.pendaftaran-invoice-spp', ['data' => $data])
                @else
                  <h5 class="text-danger">Silahkan lakukan Daftar Ulang Terlebih dahulu</h5>
                @endif
              @endif
            </div>
          </div>
      </div>
      @endif
     
      @endif
    </div>

    @if(!$data)
    <div class="row">
      <div class="col-12 text-center">
        <div class="d-grid">
          <a href="{{url('/pendaftaran/form')}}" class="btn btn-outline-primary shadow">
            <i class="bi bi-file-earmark-plus"></i> <strong>Form Pendaftaran</strong>
          </a>
        </div>
      </div>
    </div>
    @endif
    
</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 

      

    });

    function printdiv(elem) {
        var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
        var footer_str = '</body></html>';
        var new_str = document.getElementById(elem).innerHTML;
        var old_str = document.body.innerHTML;
        document.body.innerHTML = header_str + new_str + footer_str;
        window.print();
        document.body.innerHTML = old_str;
        return false;
      }
    </script>
@endpush