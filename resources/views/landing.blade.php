<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$setting->instansi}} | Portal Pendaftaran</title>

        <!-- Fonts: Outfit for Premium Feel -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('build/assets/app-016aeda7.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app-3df8c8d7.css') }}">
        <script src="{{ asset('build/assets/app-4bab669b.js') }}" defer></script>
        
        @livewireStyles
        
        <style>
            :root {
                --primary-color: #2563eb;
                --primary-dark: #1e3a8a;
                --accent-color: #f59e0b;
                --bg-soft: #f8fafc;
                --text-main: #0f172a;
                --text-muted: #64748b;
            }

            body {
                font-family: 'Outfit', sans-serif;
                color: var(--text-main);
                background-color: #ffffff;
                overflow-x: hidden;
            }

            /* Glassmorphism Navbar */
            .navbar-premium {
                backdrop-filter: blur(20px);
                background: rgba(255, 255, 255, 0.8);
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                padding: 1.2rem 1rem;
            }
            .navbar-premium.scrolled {
                padding: 0.5rem 1rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand {
                position: relative;
                padding: 0;
            }

            .navbar-brand img {
                height: 100px;
                width: auto;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
                transform-origin: top left;
                position: absolute;
                top: -15px; /* Hanging effect */
                z-index: 1050;
            }

            .navbar-premium.scrolled .navbar-brand img {
                height: 70px;
                top: -5px;
            }

            /* Custom Sections */
            .section-padding { padding: 100px 0; }
            .bg-soft { background-color: var(--bg-soft); }

            /* Hero Overhaul */
            .hero-section {
                position: relative;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }
            .hero-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to bottom, rgba(15, 23, 42, 0.6), rgba(15, 23, 42, 0.8));
            }
            .hero-content {
                position: relative;
                z-index: 10;
            }
            .hero-title {
                font-size: clamp(2.5rem, 8vw, 4.5rem);
                font-weight: 700;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                letter-spacing: -2px;
            }

            /* Premium Buttons */
            .btn-cta {
                padding: 1rem 2.5rem;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-size: 0.9rem;
            }
            .btn-primary-gradient {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
                border: none;
                color: white;
                box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
            }
            .btn-primary-gradient:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
                color: white;
            }

            /* Section Headers */
            .section-tag {
                display: inline-block;
                padding: 0.5rem 1rem;
                background: rgba(37, 99, 235, 0.1);
                color: var(--primary-color);
                border-radius: 50px;
                font-weight: 700;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 1rem;
            }
            .section-title {
                font-weight: 700;
                font-size: 2.5rem;
                margin-bottom: 2rem;
                position: relative;
            }

            /* Reveal Animations */
            .reveal {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease-out;
            }
            .reveal.active {
                opacity: 1;
                transform: translateY(0);
            }

            /* Prose & Information Formatting */
            .prose-container {
                transition: all 0.3s ease;
                padding: 1.5rem;
                border-radius: 1rem;
            }
            .prose-container:hover {
                background: #ffffff;
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
                transform: translateX(5px);
            }
            .prose p {
                margin-bottom: 1.25rem;
            }
            .prose ul {
                list-style: none;
                padding-left: 0;
            }
            .prose ul li {
                position: relative;
                padding-left: 2rem;
                margin-bottom: 0.75rem;
                transition: all 0.2s ease;
            }
            .prose ul li:hover {
                transform: translateX(10px);
                color: var(--primary-color);
            }
            .prose ul li::before {
                content: "\F26A"; /* Bootstrap check-circle */
                font-family: inherit;
                position: absolute;
                left: 0;
                top: 0;
                color: var(--primary-color);
                font-weight: 900;
                font-family: bi, bootstrap-icons;
            }

            /* Help Card Interaction */
            .help-card {
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                transition: all 0.3s ease;
            }
            .help-card:hover {
                transform: translateY(-5px);
                border-color: var(--primary-color) !important;
                background: #ffffff;
            }

            /* Footer Enhancement */
            .footer-premium {
                background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
                color: #94a3b8;
                padding: 5rem 0 0;
                position: relative;
                overflow: hidden;
            }
            .footer-premium::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            }
            .footer-links a {
                color: #94a3b8;
                text-decoration: none;
                transition: all 0.3s ease;
                display: block;
                padding: 0.3rem 0;
            }
            .footer-links a:hover {
                color: #ffffff;
                padding-left: 5px;
            }
            .social-icon {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.05);
                color: #ffffff;
                transition: all 0.3s ease;
                font-size: 1.2rem;
                text-decoration: none;
            }
            .social-icon:hover {
                background: var(--primary-color);
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);
                color: #ffffff;
            }
            .footer-bottom {
                background: rgba(0, 0, 0, 0.3);
                padding: 1.5rem 0;
                margin-top: 4rem;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
            }

            /* Scrollspy Link Active State */
            .nav-link-premium {
                color: var(--text-muted);
                font-weight: 500;
                font-size: 0.95rem;
                padding: 0.5rem 1rem !important;
                transition: color 0.3s ease;
            }
            .nav-link-premium:hover, .nav-link-premium.active {
                color: var(--primary-color) !important;
            }

            #btn-back-to-top {
                position: fixed;
                bottom: 30px;
                right: 30px;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar-premium" data-bs-offset="100">

      <!-- Premium Glass Navbar -->
      <nav id="navbar-premium" class="navbar navbar-expand-lg fixed-top navbar-premium px-3 px-md-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{url('/app-logo')}}" alt="{{$setting->instansi}}" class="brand-logo-hanging">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link nav-link-premium active" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="#pengumuman">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="#informasi">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-premium" href="#profil">Profil</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        @auth
                            <a href="/home" class="btn btn-primary-gradient px-4 rounded-pill fw-bold btn-sm">Dashboard</a>
                        @else
                            <a href="/login" class="btn btn-outline-primary px-4 rounded-pill fw-bold btn-sm me-2">Masuk</a>
                            <a href="/register" class="btn btn-primary-gradient px-4 rounded-pill fw-bold btn-sm">Daftar</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
      </nav>
            
      <!-- Modern Hero Section -->
      <section id="hero" class="hero-section" 
               style="background: {{ $setting->bg_head ? 'url('.asset('bghead/'.$setting->bg_head).')' : 'linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%)' }}; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="hero-overlay"></div>
        <div class="container hero-content text-center text-light px-4">
            <h1 class="hero-title reveal">{{$setting->head_welcome}}</h1>
            <p class="lead fs-4 mb-5 reveal" style="max-width: 800px; margin: 0 auto; opacity: 0.9;">{{$setting->selamat_datang}}</p>
            <div class="d-flex flex-column flex-md-row justify-content-center gap-3 reveal">
                @auth
                    <a href="/home" class="btn btn-cta btn-primary-gradient shadow-lg">Masuk ke Dashboard <i class="bi bi-arrow-right ms-2"></i></a>
                @else
                    <a href="/register" class="btn btn-cta btn-primary-gradient shadow-lg">Daftar Sekarang <i class="bi bi-person-plus ms-2"></i></a>
                    <a href="#informasi" class="btn btn-cta btn-outline-light px-4">Pelajari Lebih Lanjut</a>
                @endauth
            </div>

            <!-- Contact Floating Info -->
            <div class="row justify-content-center mt-5 pt-5 reveal">
                <div class="col-auto">
                    <div class="px-4 py-3 border border-white border-opacity-25 rounded-4 shadow-sm" style="background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                         @livewire('kontak-person')
                    </div>
                </div>
            </div>
        </div>
      </section>

      <!-- Pengumuman Section -->
      <section id="pengumuman" class="section-padding bg-soft border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-5 reveal">
                    <span class="section-tag">Update Terbaru</span>
                    <h2 class="section-title">Hasil Seleksi & Info Penting</h2>
                </div>
                <div class="col-lg-10 reveal">
                   <div class="card border-0 shadow-sm rounded-4 p-2 p-md-4 overflow-hidden">
                       @livewire('cari-pengumuman')
                   </div>
                </div>
            </div>
        </div>
      </section>

      <!-- Informasi Section -->
      <section id="informasi" class="section-padding bg-white">
        <div class="container px-4">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0 reveal">
                    <span class="section-tag">Informasi Pendaftaran</span>
                    <h2 class="section-title">Semua yang Perlu Anda Ketahui</h2>
                    <div class="prose-container border-start border-primary border-4 bg-light bg-opacity-10">
                        <div class="prose text-muted fs-5 lh-lg">
                            {!! $setting->informasi !!}
                        </div>
                    </div>
                    <div class="mt-4 ms-4">
                        <a href="/register" class="btn btn-link text-primary fw-bold text-decoration-none p-0">Mulai pendaftaran hari ini <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-5 reveal">
                    <div class="p-4 rounded-4 shadow-sm border help-card">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-patch-question text-primary fs-3"></i>
                            </div>
                            <h4 class="fw-bold mb-0">Butuh Bantuan?</h4>
                        </div>
                        <p class="text-muted mb-4">Jika Anda memiliki pertanyaan mengenai proses pendaftaran, silakan hubungi pusat bantuan kami atau kunjungi media sosial resmi kami.</p>
                        <hr class="my-4 opacity-10">
                        <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm mb-3">
                            <div class="bg-primary p-3 rounded-circle text-white shadow-sm">
                                <i class="bi bi-headset fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Pusat Layanan Pendaftar</h6>
                                <small class="text-muted">Aktif Jam Kerja (Senin - Jumat)</small>
                            </div>
                        </div>
                        @if($setting->kontak_hp)
                        <a href="https://wa.me/62{{substr($setting->kontak_hp, 1)}}" target="_blank" class="btn btn-success w-100 rounded-pill py-2 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </section>

      <!-- Profil Section -->
      <section id="profil" class="section-padding bg-soft">
        <div class="container px-4 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-4 reveal">
                    <span class="section-tag">Tentang Kami</span>
                    <h2 class="section-title">Profil Institusi</h2>
                </div>
                <div class="col-lg-8 reveal">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                       <div class="prose text-muted fs-5 lh-lg text-start">
                        {!! $setting->profil !!}
                       </div>
                    </div>
                </div>
            </div>
        </div>
      </section>

      <!-- Premium Footer -->
      <footer class="footer-premium">
        <div class="container px-4">
            <div class="row gy-5">
                <div class="col-lg-5">
                    <div class="pe-lg-5">
                        <img src="{{url('/app-logo')}}" style="height: 60px;" class="mb-4 brightness-200" alt="Logo">
                        <h5 class="text-white fw-bold mb-3">{{$setting->instansi}}</h5>
                        <p class="small lh-lg mb-4 opacity-75">
                            Mencetak tenaga profesional, handal, dan berakhlak mulia melalui sistem pendidikan yang inovatif dan terakreditasi unggul.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 footer-links">
                    <h6 class="text-white fw-bold mb-4">Navigasi</h6>
                    <a href="#hero">Beranda</a>
                    <a href="#pengumuman">Pengumuman</a>
                    <a href="#informasi">Informasi</a>
                    <a href="#profil">Profil Kampus</a>
                    <a href="/register">Cara Daftar</a>
                </div>
                <div class="col-lg-2 col-md-4 footer-links">
                    <h6 class="text-white fw-bold mb-4">Tautan Penting</h6>
                    <a href="https://stikespelitaibu.ac.id" target="_blank">Web Utama</a>
                    <a href="#">Sistem Informasi Alumi</a>
                    <a href="#">Repository</a>
                    <a href="#">Jurnal Penelitian</a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="text-white fw-bold mb-4">Kontak Kami</h6>
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-geo-alt text-primary fs-5"></i>
                        <span class="small opacity-75">Jl. Syech Yusuf No. 1, Kota Kendari, Sulawesi Tenggara</span>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-envelope text-primary fs-5"></i>
                        <span class="small opacity-75">info@pelitaibu.ac.id</span>
                    </div>
                    @if($setting->kontak_hp)
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-telephone text-primary fs-5"></i>
                        <span class="small opacity-75">{{$setting->kontak_hp}}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <span class="small opacity-50 text-center text-md-start">Copyright © {{date('Y')}} {{$setting->instansi}}. All right reserved.</span>
                    <div class="d-flex gap-4 small opacity-50">
                        <a href="#" class="text-decoration-none text-reset hover-white">Kebijakan Privasi</a>
                        <a href="#" class="text-decoration-none text-reset hover-white">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
      </footer>

      <!-- Floating Buttons -->
      <button type="button" class="btn btn-primary shadow-lg" id="btn-back-to-top">
        <i class="bi bi-arrow-up"></i>
      </button>

      @livewireScripts
      @livewireChartsScripts
      @stack('scripts')
      
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Navbar Scroll Effect
            const nav = document.querySelector('.navbar-premium');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });

            // Reveal Animation on Scroll
            const reveals = document.querySelectorAll(".reveal");
            const reveal = () => {
                reveals.forEach(r => {
                    const windowHeight = window.innerHeight;
                    const elementTop = r.getBoundingClientRect().top;
                    const elementVisible = 150;
                    if (elementTop < windowHeight - elementVisible) {
                        r.classList.add("active");
                    }
                });
            };
            window.addEventListener("scroll", reveal);
            // Run once on load
            reveal();

            // Back to Top Button
            const backToTopBtn = document.getElementById("btn-back-to-top");
            window.addEventListener('scroll', () => {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    backToTopBtn.style.display = "flex";
                } else {
                    backToTopBtn.style.display = "none";
                }
            });
            backToTopBtn.addEventListener("click", () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
      </script>
    </body>
</html>
>