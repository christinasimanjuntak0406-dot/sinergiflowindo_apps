<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan - SINERGI FLOWINDO</title>

  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="{{ asset('assets/css/layanan.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
</head>
<body>

  {{-- ══ HEADER ══ --}}
  <header id="header" class="header sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between py-3">
      <a href="/" class="text-decoration-none d-flex align-items-center gap-2">
        <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo" height="70">
        <div class="sitename">
          SINERGI FLOWINDO
          <small>Advanced Flow Measurement Solutions</small>
        </div>
      </a>
      <nav class="navmenu d-none d-xl-block">
        <ul>
          <li><a href="/">HOME</a></li>
          <li><a href="/produk">PRODUK</a></li>
          <li><a href="/layanan" class="active">LAYANAN</a></li>
          <li><a href="/blog">BLOG</a></li>
        </ul>
      </nav>
      <a href="/contact" class="btn-konsultasi">
        Hubungi Kami <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </header>

  <main class="main">

    {{-- ══ HERO ══ --}}
<section class="hero">
  <div class="hero-bg-img" style="background-image: url('{{ asset('assets/img/contact-hero.webp') }}')"></div>
  <div class="hero-overlay"></div>
  <div class="hero-grid"></div>
  <div class="hero-blob"></div>
  <div class="hero-ring"></div>
  <div class="container hero-content">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-duration="600">
        <span class="layanan-cat-badge">Layanan Kami</span>
        <h1 class="hero-title">Layanan Flow Meter</h1>
        <p class="hero-sub mx-auto">
          Kami menyediakan layanan lengkap untuk memastikan sistem pengukuran aliran Anda
          bekerja secara optimal, akurat, dan andal dari konsultasi hingga purna jual.
        </p>
        <div class="hero-meta-bar justify-content-center">
          <div class="hero-meta-item"><i class="bi bi-tools"></i> Instalasi Profesional</div>
          <div class="hero-meta-item"><i class="bi bi-patch-check-fill"></i> Kalibrasi Terstandar</div>
          <div class="hero-meta-item"><i class="bi bi-headset"></i> Support 24/7</div>
        </div>
      </div>
    </div>
  </div>
</section>

    {{-- ══ VIDEO / PROSES KALIBRASI SECTION ══ --}}
    <section class="video-section">
      <div class="container-xl">
        <div class="layanan-divider" data-aos="fade-up">
          <span class="divider-dot"></span>
          <span class="divider-line"></span>
          <span class="divider-label"><i class="bi bi-journals"></i> <strong>PROSES KALIBRASI KAMI</strong></span>
          <span class="divider-line"></span>
          <span class="divider-dot"></span>
        </div>

        <div class="video-grid">
          <div class="video-card">
            <div class="video-thumb" onclick="bukaVideo('7TYEOeLkSLU')">
              <img src="https://img.youtube.com/vi/7TYEOeLkSLU/mqdefault.jpg" alt="Video 1" loading="lazy">
              <div class="video-overlay">
                <svg class="yt-play-btn" viewBox="0 0 68 48" xmlns="http://www.w3.org/2000/svg">
                  <path class="yt-play-bg" d="M66.52 7.74c-.78-2.93-2.49-5.41-5.42-6.19C55.79.13 34 0 34 0S12.21.13 6.9 1.55c-2.93.78-4.63 3.26-5.42 6.19C.06 13.05 0 24 0 24s.06 10.95 1.48 16.26c.78 2.93 2.49 5.41 5.42 6.19C12.21 47.87 34 48 34 48s21.79-.13 27.1-1.55c2.93-.78 4.64-3.26 5.42-6.19C67.94 34.95 68 24 68 24s-.06-10.95-1.48-16.26z"/>
                  <path class="yt-play-icon" d="M45 24 27 14v20z"/>
                </svg>
              </div>
            </div>
          </div>

          <div class="video-card">
            <div class="video-thumb" onclick="bukaVideo('7TYEOeLkSLU')">
              <img src="https://img.youtube.com/vi/7TYEOeLkSLU/mqdefault.jpg" alt="Video 2" loading="lazy">
              <div class="video-overlay">
                <svg class="yt-play-btn" viewBox="0 0 68 48" xmlns="http://www.w3.org/2000/svg">
                  <path class="yt-play-bg" d="M66.52 7.74c-.78-2.93-2.49-5.41-5.42-6.19C55.79.13 34 0 34 0S12.21.13 6.9 1.55c-2.93.78-4.63 3.26-5.42 6.19C.06 13.05 0 24 0 24s.06 10.95 1.48 16.26c.78 2.93 2.49 5.41 5.42 6.19C12.21 47.87 34 48 34 48s21.79-.13 27.1-1.55c2.93-.78 4.64-3.26 5.42-6.19C67.94 34.95 68 24 68 24s-.06-10.95-1.48-16.26z"/>
                  <path class="yt-play-icon" d="M45 24 27 14v20z"/>
                </svg>
              </div>
            </div>
          </div>

          <div class="video-card">
            <div class="video-thumb" onclick="bukaVideo('7TYEOeLkSLU')">
              <img src="https://img.youtube.com/vi/7TYEOeLkSLU/mqdefault.jpg" alt="Video 3" loading="lazy">
              <div class="video-overlay">
                <svg class="yt-play-btn" viewBox="0 0 68 48" xmlns="http://www.w3.org/2000/svg">
                  <path class="yt-play-bg" d="M66.52 7.74c-.78-2.93-2.49-5.41-5.42-6.19C55.79.13 34 0 34 0S12.21.13 6.9 1.55c-2.93.78-4.63 3.26-5.42 6.19C.06 13.05 0 24 0 24s.06 10.95 1.48 16.26c.78 2.93 2.49 5.41 5.42 6.19C12.21 47.87 34 48 34 48s21.79-.13 27.1-1.55c2.93-.78 4.64-3.26 5.42-6.19C67.94 34.95 68 24 68 24s-.06-10.95-1.48-16.26z"/>
                  <path class="yt-play-icon" d="M45 24 27 14v20z"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- ══ LAYANAN KAMI SECTION ══ --}}
    <section class="layanan-section">
      <div class="container-xl">
        <div class="layanan-divider" data-aos="fade-up">
          <span class="divider-dot"></span>
          <span class="divider-line"></span>
          <span class="divider-label"><i class="bi bi-journals"></i> <strong>LAYANAN KAMI</strong></span>
          <span class="divider-line"></span>
          <span class="divider-dot"></span>
        </div>

        <div class="layanan-grid">

          <div class="layanan-card" data-aos="fade-up" data-aos-delay="0">
            <div class="layanan-card-img">
              <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Instalasi">
            </div>
            <div class="layanan-card-body">
              <h4>Instalasi</h4>
              <p>Pemasangan dan setup pengukuran sesuai standar kebutuhan industri.</p>
            </div>
          </div>

          <div class="layanan-card" data-aos="fade-up" data-aos-delay="100">
            <div class="layanan-card-img">
              <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Kalibrasi">
            </div>
            <div class="layanan-card-body">
              <h4>Kalibrasi</h4>
              <p>Pengujian dan penyetelan akurasi alat ukur sesuai standar internasional.</p>
            </div>
          </div>

          <div class="layanan-card" data-aos="fade-up" data-aos-delay="200">
            <div class="layanan-card-img">
              <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Perawatan">
            </div>
            <div class="layanan-card-body">
              <h4>Perawatan & Perbaikan</h4>
              <p>Pemeliharaan berkala dan perbaikan cepat untuk menjaga performa alat ukur.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    {{-- ══ YOUTUBE MODAL ══ --}}
    <div class="yt-modal-backdrop" id="ytBackdrop" onclick="tutupVideo(event)">
      <div class="yt-modal">
        <button class="yt-close" onclick="tutupVideo()">
          <i class="bi bi-x-lg"></i>
        </button>
        <iframe id="ytFrame" src="" allowfullscreen allow="autoplay"></iframe>
      </div>
    </div>

    {{-- ══ FOOTER ══ --}}
 </footer>
<footer id="footer">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-4 col-md-6">
        <div class="d-flex align-items-center gap-2 mb-2">
          <div class="sitename">SINERGI FLOWINDO<small>Advanced Flow Measurement Solutions</small></div>
        </div>
        <p class="footer-tagline">Solusi flow meter industri terpercaya dengan kualitas dan akurasi terbaik.</p>
      </div>
      <div class="col-lg-2 col-md-3">
        <div class="footer-heading">Useful Links</div>
        <ul class="footer-links-list">
          <li><a href="/"><i class=""></i>HOME</a></li>
          <li><a href="/produk"><i class=""></i>PRODUK</a></li>
          <li><a href="/layanan"><i class=""></i>LAYANAN</a></li>
          <li><a href="/blog"><i class=""></i>BLOG</a></li>
          <li><a href="/contact"><i class=""></i>KONTAK</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-heading">Kontak</div>
        <ul class="footer-links-list">
          <li><a href="#"><i class="bi bi-geo-alt"></i>Mega Glodok Kemayoran (MGK Mall) Lantai GF Blok B7 No.9 Jln.Angkasa No.6 Blok B10 Gunung Sahari Selatan Central Jakarta</a></li>
          <li><a href="tel:+6281234567890"><i class="bi bi-telephone"></i>+62 812 6587 1759</a></li>
          <li><a href="mailto:sinergiflowindo@gmail.com"><i class="bi bi-envelope"></i>sinergiflowindo@gmail.com</a></li>
          <li><a href="#"><i class="bi bi-clock"></i>Senin–Jumat, 08.00–17.00</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="footer-heading">Ikuti Kami</div>
        <div class="d-flex gap-2 flex-wrap">
          <a href="#" style="width:36px;height:36px;background:rgba(255,255,255,.06);border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.5);font-size:15px;text-decoration:none;transition:background .2s,color .2s;" onmouseover="this.style.background='var(--orange)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,.06)';this.style.color='rgba(255,255,255,.5)'"><i class="bi bi-facebook"></i></a>
          <a href="#" style="width:36px;height:36px;background:rgba(255,255,255,.06);border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.5);font-size:15px;text-decoration:none;transition:background .2s,color .2s;" onmouseover="this.style.background='var(--orange)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,.06)';this.style.color='rgba(255,255,255,.5)'"><i class="bi bi-instagram"></i></a>
          <a href="https://wa.me/6281265871759" target="_blank" style="width:36px;height:36px;background:rgba(255,255,255,.06);border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.5);font-size:15px;text-decoration:none;transition:background .2s,color .2s;" onmouseover="this.style.background='var(--orange)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,.06)';this.style.color='rgba(255,255,255,.5)'"><i class="bi bi-whatsapp"></i></a>
          <a href="#" style="width:36px;height:36px;background:rgba(255,255,255,.06);border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.5);font-size:15px;text-decoration:none;transition:background .2s,color .2s;" onmouseover="this.style.background='var(--orange)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,.06)';this.style.color='rgba(255,255,255,.5)'"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom text-center mt-4">
  <span>© {{ date('Y') }} <strong>SINERGI FLOWINDO</strong> All Rights Reserved.</span>
  <br>
  <span>Designned by <a href="#" target="_blank">Christina N </a></span>
</div>
  </div>
</footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
      <i class="bi bi-arrow-up-short"></i>
    </a>

    <div id="preloader"></div>

  </main>

  {{-- ══ SCRIPTS ══ --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script>
    AOS.init({ duration: 200, once: true });
  </script>
  <script>
    function bukaVideo(id) {
      document.getElementById('ytFrame').src =
        'https://www.youtube.com/embed/' + id + '?autoplay=1';
      document.getElementById('ytBackdrop').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function tutupVideo(e) {
      if (e && e.target !== document.getElementById('ytBackdrop')) return;
      document.getElementById('ytFrame').src = '';
      document.getElementById('ytBackdrop').classList.remove('active');
      document.body.style.overflow = '';
    }
  </script>

</body>
</html>