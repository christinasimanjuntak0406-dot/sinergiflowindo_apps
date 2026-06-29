<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak - SINERGI FLOWINDO</title>

  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/contact.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">

</head>
<body class="contact-page">

  {{-- ══════════ HEADER ══════════ --}}
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
          <li><a href="/layanan">LAYANAN</a></li>
          <li><a href="/blog">BLOG</a></li>
        </ul>
      </nav>

      <a href="/contact" class="btn-konsultasi">
        Hubungi Kami <i class="bi bi-arrow-right"></i>
      </a>

    </div>
  </header>

  <main class="main">

    {{-- ══════════ HERO ══════════ --}}
    <section class="contact-hero">

      <div class="contact-hero-bg" style="background-image: url('{{ asset('assets/img/contact-hero.webp') }}')"></div>

      <div class="contact-hero-img">
        <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Kontak Sinergi Flowindo">
      </div>

      <div class="contact-hero-inner">
        <div class="container-fluid container-xl">
          <div class="row">
            <div class="col-lg-7">
              <span class="contact-cat-badge">Hubungi Kami</span>
              <h1 class="contact-hero-title">
                Konsultasikan Kebutuhan Flow Meter Anda Bersama Kami
              </h1>
              <p class="contact-hero-desc">
                Tim ahli kami siap membantu Anda menemukan solusi pengukuran aliran yang tepat
                untuk kebutuhan industri Anda. Kirimkan pertanyaan atau permintaan penawaran sekarang.
              </p>

              <div class="contact-meta-bar">
                <div class="contact-meta-item">
                  <i class="bi bi-telephone-fill"></i>
                  +62 812-3456-7890
                </div>
                <div class="contact-meta-item">
                  <i class="bi bi-envelope-fill"></i>
                  sinergiflowindo@gmail.com
                </div>
                <div class="contact-meta-item">
                  <i class="bi bi-clock-fill"></i>
                  Senin – Jumat, 08.00–17.00 WIB
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  <section style="padding:50px 0; background:var(--bg);">
    <div class="container">

      {{-- Info Cards --}}
      <div class="row gy-4 mb-4">
        <div class="col-md-3 col-6">
          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <div class="contact-info-label">Alamat</div>
            <div class="contact-info-value">Mega Glodok Kemayoran (MGK Mall) Lantai GF Blok B7 No.9 Jln.Angkasa No.6 Blok B10 Gunung Sahari Selatan Central Jakarta</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="bi bi-telephone-fill"></i></div>
            <div class="contact-info-label">Telepon</div>
            <div class="contact-info-value"><a href="tel:+6281265871759">+62 812-6587-1759</a></div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="bi bi-envelope-fill"></i></div>
            <div class="contact-info-label">Email</div>
            <div class="contact-info-value"><a href="mailto:sinergiflowindo@gmail.com">sinergiflowindo@gmail.com</a></div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="bi bi-whatsapp"></i></div>
            <div class="contact-info-label">WhatsApp</div>
            <div class="contact-info-value"><a href="https://wa.me/6281265871759">+62 812-6587-1759</a></div>
          </div>
        </div>
      </div>

      {{-- Map + Jam Operasional --}}
      <div class="row gy-4 mb-4">
        <div class="col-lg-8">
          <div class="contact-map-card">
            <div class="contact-map-header">
              <i class="bi bi-map-fill"></i>
              <div>
                <div style="font-weight:700;font-size:13px;">Lokasi Kami</div>
                <div style="font-size:11px;color:rgba(255,255,255,0.5);">Jakarta, Indonesia</div>
              </div>
            </div>
            <iframe
              src="https://maps.google.com/maps?q=Mega+Glodok+Kemayoran+Mall+Jl+Angkasa+Gunung+Sahari+Jakarta+Pusat&t=&z=16&ie=UTF8&iwloc=&output=embed"
              style="width:100%;height:280px;border:none;display:block;" 
              allowfullscreen 
              loading="lazy">
            </iframe>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="contact-hours-card">
            <div class="contact-hours-title"><i class="bi bi-clock-fill"></i> Jam Operasional</div>
            <div class="contact-hours-row">
              <span>Senin – Jumat</span>
              <div class="d-flex align-items-center gap-2">
                <span style="color:#fff;font-weight:600;">08.00–17.00</span>
                <span class="contact-open-badge">Buka</span>
              </div>
            </div>
            <div class="contact-hours-row">
              <span>Sabtu & Minggu</span>
              <span style="color:rgba(255,255,255,0.3);">Tutup</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Tombol WhatsApp --}}
      <a href="https://wa.me/6281265871759" target="_blank" class="btn-wa-full">
        <i class="bi bi-whatsapp"></i> Chat WhatsApp Sekarang
      </a>

    </div>
  </section>
  </main>

  {{-- ══════════ FOOTER ══════════ --}}
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script><div id="preloader"></div>

  {{-- ══════════ SCRIPTS ══════════ --}}
  
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script>
    AOS.init({ duration: 200, once: true });
  </script>

</body>
</html>