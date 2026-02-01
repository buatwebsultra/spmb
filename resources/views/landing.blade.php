<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>STIKES PELITA IBU KENDARI</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        
    
    {{-- <style>
            
    </style> --}}
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite(['resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-016aeda7.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-3df8c8d7.css') }}">
    <script src="{{ asset('build/assets/app-4bab669b.js') }}" defer></script>
    @livewireStyles
    </head>
    <body  style="background-color: #4cc8fb">
      <nav id="navbar-example2" class="navbar navbar-dark px-3 mb-3 fixed-top " >
        <a class="navbar-brand" href="/">
          <img src="{{url('/assets/alumni_uho.png')}}" alt="AlumniUHO" class="d-inline-block align-text-top">
        </a>
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link text-light" href="#scrollspyHeading1">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#scrollspyHeading4">Pengumuman</a>
        </li>
          <li class="nav-item">
              <a class="nav-link text-light" href="#scrollspyHeading2">Informasi</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light" href="#scrollspyHeading3">Profil</a>
          </li>
        </ul>
      </nav>
            
      <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -25%" data-bs-smooth-scroll="true" 
                    class="scrollspy-example rounded-2" tabindex="0" style="background-color: #4cc8fb">
        <div id="scrollspyHeading1" class="container-fluid min-vh-100 d-flex flex-column mb-4" 
          style="background-image: url({{url('/bghead')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
          <div class="row flex-grow-1 px-3 text-center  d-flex align-items-center">
            <div class="col text-light">
              <h1>{{$setting->head_welcome}}</h1>
              <p class="lead">{{$setting->selamat_datang}}</p>
              <p class="lead">
                @auth
                <a href="/home" class="btn btn-lg btn-secondary fw-bold border-white bg-primary shadow">Akun Saya</a>
                @else
                <a href="/register" class="btn btn-lg btn-secondary fw-bold border-white bg-primary shadow">Buat Akun</a>
                <a href="/login" class="btn btn-lg btn-secondary fw-bold border-white bg-primary shadow">Masuk Akun</a>
                @endauth
              
              </p>
              <div class="position-absolute bottom-0 start-50 translate-middle-x d-flex mb-2">
                  <div class="flex-fill border rounded  p-2" style="background-color: rgba(0, 0, 0, 0.5)">
                    @livewire('kontak-person')
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div id="scrollspyHeading4" class="mb-4 mx-3">
          <div class="row">
            <div class="col-sm">
              @livewire('cari-pengumuman')
            </div>
          </div>
        </div>

        <div id="scrollspyHeading2" class="card mb-4 mx-3 p-3  shadow">
          <h4 class="card-header text-primary  bg-info">Informasi</h4>
          <div class="card-body">
          <p>
          {!! $setting->informasi !!}
          </p>
          </div>
        </div>
        <div id="scrollspyHeading3" class="card mb-4 mx-3 p-3  shadow">
          <h4 class="card-header text-primary  bg-info">Profil</h4>
          <div class="card-body">
            <p>
              {!! $setting->profil !!}
            </p>
          </div>
        </div>
    </div>
            {{-- <main class="container container-fluid px-3 w-100" style="padding-top: 80px">
                
            </main>  --}}
            <footer class="mt-auto text-white-50 text-center p-4" style="background-color: #4cc8fb; text-shadow: 1px 1px #707070;">
                <span>Copyright © STIKES PELITA IBU KENDARI. All right reserved.</span>
                <button type="button" class="btn btn-success btn-floating btn-md" id="btn-back-to-top">
                  <i class="bi bi-arrow-up"></i>
                </button>
            </footer>
        @livewireScripts
        @livewireChartsScripts
        @stack('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function(event) { 
                //Get the button
                let mybutton = document.getElementById("btn-back-to-top");
                const nave = document.getElementById("navbar-example2");
                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function () {
                scrollFunction();
                };
    
                function scrollFunction() {
                if (
                    document.body.scrollTop > 20 ||
                    document.documentElement.scrollTop > 20
                ) {
                    mybutton.style.display = "block";
                    nave.classList.add('shadow');
                    nave.style.backgroundColor = "#4cc8fb";
                } else {
                    mybutton.style.display = "none";
                    nave.classList.remove('shadow');
                    nave.style.backgroundColor = "";
                }
                }
                // When the user clicks on the button, scroll to the top of the document
                mybutton.addEventListener("click", backToTop);
    
                function backToTop() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                }
            });
          </script>
    </body>

</html>