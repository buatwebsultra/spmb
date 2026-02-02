<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite(['resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-016aeda7.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-3df8c8d7.css') }}">
    <script src="{{ asset('build/assets/app-4bab669b.js') }}" defer></script>
    @livewireStyles
    @stack('stylesrel')
    @stack('scriptsrel')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('/assets/alumni_uho.png')}}" alt="StikesPIK">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                          
                            @if (Route::has('home'))
                                <li class="nav-item">
                                    <a class="nav-link {{ (Route::currentRouteName()=='home') ? ' active':''}}" href="{{ route('home') }}"><i class="bi bi-speedometer"></i> {{ __('Dashboard') }}</a>
                                </li>
                            @endif

                            @if(auth()->user()->level_id==1)
                                @if (Route::has('pendaftaran'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::currentRouteName()== 'pendaftaran' ? ' active':''}}" href="{{ route('pendaftaran') }}"><i class="bi bi-person-badge"></i> {{ __('Pendaftaran') }}</a>
                                    </li>
                                @endif    

                                @if (Route::has('seleksi'))
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle {{ str_contains(Route::currentRouteName(), 'seleksi') ? ' active':''}}" href="{{ route('seleksi') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="bi bi-cash-coin"></i> Seleksi</a>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item {{ Route::currentRouteName() == 'seleksi' ? ' fw-bold ':''}}" href="{{ route('seleksi') }}">
                                            Jadwal & Hasil Ujian
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item {{ Route::currentRouteName() == 'seleksi.jadwal' ? ' fw-bold ':''}}" href="{{ route('seleksi.jadwal') }}">
                                            Jadwal Ujian
                                        </a>
                                        <a class="dropdown-item {{ Route::currentRouteName() == 'seleksi.hasil' ? ' fw-bold ':''}}" href="{{ route('seleksi.hasil') }}">
                                            Hasil Ujian
                                        </a>
                                    </div>
                                </li>
                                @endif

                                @if (Route::has('daftarulang'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteName()== 'daftarulang' ? ' active':''}}" href="{{ route('daftarulang') }}"><i class="bi bi-person-badge"></i> {{ __('Daftar Ulang') }}</a>
                                </li>
                                @endif
                                
                                @if (Route::has('pembayaran'))
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle {{ str_contains(Route::currentRouteName(), 'pembayaran') ? ' active':''}}" href="{{ route('pembayaran') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="bi bi-cash-coin"></i> Pembayaran</a>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item {{ Route::currentRouteName() == 'pembayaran' ? ' fw-bold ':''}}" href="{{ route('pembayaran') }}">
                                            Data
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item {{ Route::currentRouteName() == 'pembayaran.pendaftaran' ? ' fw-bold ':''}}" href="{{ route('pembayaran.pendaftaran') }}">
                                            Pendaftaran
                                        </a>
                                        <a class="dropdown-item {{ Route::currentRouteName() == 'pembayaran.spp' ? ' fw-bold ':''}}" href="{{ route('pembayaran.spp') }}">
                                            Biaya Masuk
                                        </a>
                                    </div>
                                </li>
                                @endif



                                @if (Route::has('info'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(Route::currentRouteName(), 'info') ? ' active':''}}" href="{{ route('info') }}"><i class="bi bi-info-circle"></i> {{ __('Info') }}</a>
                                    </li>
                                @endif
                                
                                {{-- @if (Route::has('input-info'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ (Route::currentRouteName()=='input-info') ? ' active':''}}" href="{{ route('input-info') }}">{{ __('Publish') }}</a>
                                    </li>
                                @endif --}}
                                @if (Route::has('link'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(Route::currentRouteName(), 'link') ? ' active':''}}" href="{{ route('link') }}"><i class="bi bi-link"></i> {{ __('Tautan') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('setting'))
                                    @if(auth()->user()->jurusan_id > 0)
                                        @if (Route::has('setting.pengguna'))
                                            <li class="nav-item">
                                                <a class="nav-link {{ Route::currentRouteName() == 'setting.pengguna' ? ' active':''}}" href="{{ route('setting.pengguna') }}"><i class="bi bi-person"></i> {{ __('Data Akun MABA') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle {{ str_contains(Route::currentRouteName(), 'setting') ? ' active':''}}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <i class="bi bi-gear"></i> Pengaturan</a>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item {{ Route::currentRouteName() == 'setting.aplikasi' || Route::currentRouteName() == 'setting' ? ' fw-bold ':''}}" href="{{ route('setting.aplikasi') }}">
                                                    <i class="bi bi-gear"></i> Aplikasi
                                                </a>
                                                <hr class="dropdown-divider">
                                                <a class="dropdown-item {{ Route::currentRouteName() == 'setting.pengguna' ? ' fw-bold ':''}}" href="{{ route('setting.pengguna') }}">
                                                    <i class="bi bi-person"></i> Pengguna
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                @endif
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item p-1">
                                    <a class="nav-link btn btn-sm btn-outline-info text-light" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                </li>
                            @endif
                            @if(Route::currentRouteName() != 'register')    
                            @if (Route::has('register'))
                                <li class="nav-item p-1">
                                    <a class="nav-link btn btn-sm btn-outline-info text-light" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-x-circle"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @auth
        @if (Route::currentRouteName()!='home' && Route::currentRouteName() != 'verification.notice' && !str_contains(Route::currentRouteName(), 'setting'))
        <livewire:breadcrumb /> 
        @endif
        @endauth
        <main class="py-2">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    @livewireChartsScripts
    @stack('scripts')
</body>
</html>
