<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- @vite(['resources/js/app.js']) --}}
    @livewireStyles
    </head>
    <body>
      <div class="container">
        <nav class="navbar navbar-expand-lg bg-success navbar-dark text-white fixed-top">
          <div class="container-fluid">
            <a class="navbar-brand flex-nowrap" href="/">
              <img src="{{url('/assets/alumni_uho.png')}}" alt="AlumniUHO" class="d-inline-block align-text-top">
              <i class="bi bi-house" style="vertical-align: -0.5em;"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link {{ str_contains(Route::currentRouteName(), 'data') ? ' active':''}}" aria-current="page" href="{{ route('data') }}"><i class="bi bi-person-badge"></i> Data</a>
                </li>
                {{-- <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled">Disabled</a>
                </li> --}}
              </ul>
              <form class="d-flex" role="search" action="{{ route('pencarian') }}">
                <input class="form-control me-2" type="search" placeholder="Cari informasi..." name="cari" aria-label="Cari">
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                @auth
                <a href="{{url('/home')}}"  class="btn btn-outline-light mx-2" type="submit"><i class="bi bi-house"></i> </a>
                @else
                <a href="{{url('/login')}}"  class="btn btn-outline-light mx-2" type="submit"><i class="bi bi-key"></i> </a>
              @endauth
              </form>
              
            </div>
          </div>
        </nav>
      </div>
      <div class="row" style="margin-top: 50px"> 
        <div class="col">
          <livewire:blog.header /> 
        </div>
      </div>
      
        <main class="container">
          <livewire:blog.top /> 
          
          <div class="row g-5">
            <div class="col-md-8">
              <h4 class="fst-italic  border-bottom title-head fit-stoke mt-3">
                Informasi
              </h4>
              <livewire:blog.left /> 
            </div>
        
            <div class="col-md-4">
              <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded">
                  <h4 class="fst-italic  border-bottom title-head fit-stoke">Tentang</h4>
                  <livewire:blog.about /> 
                </div>
                <div class="p-4 mb-3 bg-light rounded">
                  <h4 class="fst-italic  border-bottom title-head fit-stoke">Terakhir Terdaftar</h4>
                  <livewire:blog.last-alumni /> 
                </div>
                <div class="p-4">
                  <h4 class="fst-italic  border-bottom  title-head fit-stoke">Statistik</h4>
                  <livewire:blog.chart-prodi /> 
                </div>
                <div class="p-4">
                  <h4 class="fst-italic  border-bottom  title-head fit-stoke">Tautan</h4>
                  <livewire:blog.links /> 
                </div>
        
                {{-- <div class="p-4">
                  <h4 class="fst-italic">Elsewhere</h4>
                  <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                  </ol>
                </div> --}}
              </div>
            </div>
          </div>
        
        </main>
        
        <footer class="blog-footer text-light" style="background-color: orange">
          <span>Copyright © UHO. All right reserved.</span>
          <button type="button" class="btn btn-success btn-floating btn-md" id="btn-back-to-top">
            <i class="bi bi-arrow-up"></i>
          </button>
        </footer>
        <!-- Back to top button -->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Ketik untuk memulai pencarian...">
                    <datalist id="datalistOptions">
                      <option value="San Francisco">
                      <option value="New York">
                      <option value="Seattle">
                      <option value="Los Angeles">
                      <option value="Chicago">
                    </datalist>
                </div>
            </div>
            </div>
        </div>
        
        @livewireScripts
        @livewireChartsScripts
        @stack('scripts')
        <script>
          //Get the button
          let mybutton = document.getElementById("btn-back-to-top");

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
            } else {
              mybutton.style.display = "none";
            }
          }
          // When the user clicks on the button, scroll to the top of the document
          mybutton.addEventListener("click", backToTop);

          function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
          }
        </script>
    </body>
</html>
