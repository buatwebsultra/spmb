<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
        }

        .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        }

        .bi {
        vertical-align: -.125em;
        fill: currentColor;
        }

        .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
        }

        .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        }
    </style>
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
              <i class="bi bi-house"  style="vertical-align: -0.5em;"></i>
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
                <a href="{{url('/home')}}"  class="btn btn-outline-light ms-2" type="submit"><i class="bi bi-house"></i> </a>
                @else
                <a href="{{url('/login')}}"  class="btn btn-outline-light ms-2" type="submit"><i class="bi bi-key"></i> </a>
                @endauth
              </form>
            </div>
          </div>
        </nav>
      </div>
        
        <main class="container" style="margin-top: 80px">
            @yield('content')

            <div class="row g-5 mt-3">
              <div class="col">
                <h4 class="fst-italic  border-bottom title-head fit-stoke mt-3">
                  Informasi
                </h4>
                <livewire:blog.top /> 
              </div>
            </div>
        </main>
        
        
        <footer class="blog-footer text-light" style="background-color: orange">
          <span>Copyright © UHO. All right reserved.</span>
          <button type="button" class="btn btn-success btn-floating btn-md" id="btn-back-to-top">
            <i class="bi bi-arrow-up"></i>
          </button>
        </footer>
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
