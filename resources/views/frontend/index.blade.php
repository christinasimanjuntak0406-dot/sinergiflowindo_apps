<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SINERGI FLOWINDO — Flow Meter Industri</title>
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="Flow meter berkualitas untuk kebutuhan industri">

  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/layanan.css') }}" rel="stylesheet">
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
        <li><a href="/" class="active">HOME</a></li>
        <li><a href="/produk">PRODUK </a></li>
        <li><a href="/layanan">LAYANAN</a></li>
        <li><a href="/blog">BLOG</a></li>
      </ul>
    </nav>
    <div class="toolbar-search">
      <i class="bi bi-search"></i>
      <input type="text" placeholder="Cari produk...">
    </div>

    {{-- Tombol hamburger, hanya tampil di bawah 1200px --}}
    <button class="mobile-nav-toggle d-xl-none" id="mobileNavToggle" aria-label="Buka menu">
      <i class="bi bi-list"></i>
    </button>
  </div>
</header>

{{-- Panel menu mobile --}}
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
<div class="mobile-nav-panel" id="mobileNavPanel">
  <button class="mobile-nav-close" id="mobileNavClose" aria-label="Tutup menu">&times;</button>
  <ul>
    <li><a href="/" class="active">HOME</a></li>
    <li><a href="/produk">PRODUK</a></li>
    <li><a href="/layanan">LAYANAN</a></li>
    <li><a href="/blog">BLOG</a></li>
  </ul>
  <a href="/contact" class="btn-getstarted-mobile">Hubungi Kami</a>
</div>

<main>

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
          <h1 class="hero-title">
            SINERGI FLOWINDO
          </h1>
          <p class="hero-sub mx-auto">
            Flow meter berkualitas tinggi untuk kebutuhan industri Anda. Solusi pengukuran aliran terpercaya dengan akurasi presisi tinggi dan dukungan teknis penuh.
          </p>
          <div class="hero-meta-bar justify-content-center">
            <div class="hero-meta-item"><i class="bi bi-shield-fill-check"></i> Kualitas Terjamin</div>
            <div class="hero-meta-item"><i class="bi bi-headset"></i> Support 24/7</div>
            <div class="hero-meta-item"><i class="bi bi-lightning-fill"></i> Pengiriman Cepat</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- ══ PRODUK ══ --}}
  @if($produk->count() > 0)
  <section class="produk-section">
    <div class="container">
      <div class="row align-items-end mb-5" data-aos="fade-up">
        <div class="col-lg-6">
          <h2 class="section-title">Pilihan Produk Terbaik</h2>
        </div>
        <div class="col-lg-6 d-flex align-items-end justify-content-lg-end">
          <a href="/produk" class="btn-all">
            Semua Produk <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="row gy-4">
        @foreach($produk as $item)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
          <a href="{{ route('produk.detail', $item->slug) }}" class="produk-card">
            @if($item->gambar)  
            <div class="produk-img">
              <span class="produk-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
              <img src="{{ asset('uploads/produk/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" loading="lazy">
            </div>
            @else
            <div class="produk-img-placeholder">
              <i class="bi bi-box-seam"></i>
            </div>
            @endif

            <div class="produk-body">
              @if(isset($item->category) && $item->category)
              <div class="produk-cat">{{ $item->category->name }}</div>
              @endif
              <div class="produk-name">{{ $item->nama_produk }}</div>
              <div class="produk-desc">{{ Str::limit(strip_tags($item->deskripsi), 90) }}</div>
              <span class="produk-link">
                Lihat Detail <i class="bi bi-arrow-right"></i>
              </span>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif
  {{-- ══ LAYANAN ══ --}}
<section class="layanan-section">
  <div class="container">
    <div class="container">
      <div class="row align-items-end mb-5" data-aos="fade-up">
        <div class="col-lg-6">
          <h2 class="section-title">Layanan Kami</h2>
        </div>
        <div class="col-lg-6 d-flex align-items-end justify-content-lg-end">
          <a href="/layanan" class="btn-all">
            Lihat Semua Layanan <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="0">
        <div class="layanan-card w-100">
          <div class="layanan-card-img">
            <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Instalasi" style="width:100%;height:180px;object-fit:cover;">
          </div>
          <div class="layanan-card-body" style="padding:20px;">
            <div class="layanan-icon"><i class="bi bi-tools"></i></div>
            <h4><a href="/layanan">Instalasi</a></h4>
            <p>Pemasangan dan setup pengukuran sesuai standar kebutuhan industri.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="layanan-card w-100">
          <div class="layanan-card-img">
            <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Kalibrasi" style="width:100%;height:180px;object-fit:cover;">
          </div>
          <div class="layanan-card-body" style="padding:20px;">
            <div class="layanan-icon"><i class="bi bi-patch-check-fill"></i></div>
            <h4><a href="/layanan">Kalibrasi</a></h4>
            <p>Pengujian dan penyetelan akurasi alat ukur sesuai standar internasional.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="layanan-card w-100">
          <div class="layanan-card-img">
            <img src="{{ asset('assets/img/contact-hero.webp') }}" alt="Perawatan" style="width:100%;height:180px;object-fit:cover;">
          </div>
          <div class="layanan-card-body" style="padding:20px;">
            <div class="layanan-icon"><i class="bi bi-wrench-adjustable"></i></div>
            <h4><a href="/layanan">Perawatan & Perbaikan</a></h4>
            <p>Pemeliharaan berkala dan perbaikan cepat untuk menjaga performa alat ukur.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  {{-- ══ KENAPA KAMI ══ --}}
  <section class="why-section">
    <div class="container">
      <div class="row align-items-end mb-5" data-aos="fade-up">
        <div class="col-lg-6">
          <h2 class="section-title">Mengapa Memilih Kami?</h2>
        </div>
      </div>
      <div class="row gy-4">
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
          <div class="why-card">
            <div class="why-icon"><i class="bi bi-award-fill"></i></div>
            <h5>Produk Berkualitas</h5>
            <p>Flow meter dari merek terpercaya dengan standar kualitas internasional untuk keandalan maksimal.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="80">
          <div class="why-card">
            <div class="why-icon"><i class="bi bi-people-fill"></i></div>
            <h5>Tim Ahli Berpengalaman</h5>
            <p>Didukung oleh insinyur dan teknisi berpengalaman lebih dari 10 tahun di industri flow measurement.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="160">
          <div class="why-card">
            <div class="why-icon"><i class="bi bi-headset"></i></div>
            <h5>Support 24/7</h5>
            <p>Layanan dukungan teknis tersedia kapan saja untuk memastikan operasional Anda berjalan tanpa gangguan.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="240">
          <div class="why-card">
            <div class="why-icon"><i class="bi bi-truck"></i></div>
            <h5>Pengiriman Tepat Waktu</h5>
            <p>Jaringan distribusi luas memastikan produk sampai ke tangan Anda tepat waktu dan dalam kondisi sempurna.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ══ CTA BANNER ══ --}}
  <div class="cta-banner">
    <div class="container position-relative" style="z-index:2">
      <div class="row align-items-center gy-4">
        <div class="col-lg-8" data-aos="fade-right">
          <h3 class="title">BUTUH KONSULTASI FLOW METER?</h3>
          <p class="sub">Tim ahli kami siap membantu memilih solusi terbaik untuk kebutuhan industri Anda.</p>
        </div>
        <div class="col-lg-4 text-lg-end" data-aos="fade-left">
          <a href="https://wa.me/6281265871759" target="_blank" class="btn-cta-white">
            <i class="bi bi-whatsapp"></i> Chat WhatsApp
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

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

<a href="#" class="scroll-top" id="scrollTop">
  <i class="bi bi-arrow-up-short"></i>
</a>

<div id="preloader"></div>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
  AOS.init({ duration: 200, once: true, offset: 60 });

  // Scroll top button
  const scrollTop = document.getElementById('scrollTop');
  window.addEventListener('scroll', () => {
    scrollTop.classList.toggle('active', window.scrollY > 300);
  });

  // ── Mobile Nav ──
  const MobileNav = {
    toggle  : document.getElementById('mobileNavToggle'),
    close   : document.getElementById('mobileNavClose'),
    overlay : document.getElementById('mobileNavOverlay'),
    panel   : document.getElementById('mobileNavPanel'),

    init() {
      this.toggle.addEventListener('click', () => this.open());
      this.close.addEventListener('click', () => this.closePanel());
      this.overlay.addEventListener('click', () => this.closePanel());
    },

    open() {
      this.overlay.classList.add('is-open');
      this.panel.classList.add('is-open');
    },

    closePanel() {
      this.overlay.classList.remove('is-open');
      this.panel.classList.remove('is-open');
    }
  };

  MobileNav.init();
</script>
<script>
  const searchInput = document.querySelector('.toolbar-search input');

  searchInput.addEventListener('input', function () {
    const keyword = this.value.toLowerCase().trim();
    const produkSection = document.querySelector('.produk-section');
    const produkCards = document.querySelectorAll('.produk-section .col-lg-4');

    // Jika tidak ada section produk, arahkan ke halaman produk
    if (!produkSection) {
      if (keyword.length > 1) {
        window.location.href = '/produk?search=' + encodeURIComponent(this.value);
      }
      return;
    }

    produkCards.forEach(col => {
      const nama = col.querySelector('.produk-name')?.textContent.toLowerCase() || '';
      const desc = col.querySelector('.produk-desc')?.textContent.toLowerCase() || '';
      const cat  = col.querySelector('.produk-cat')?.textContent.toLowerCase() || '';
      col.style.display = (nama.includes(keyword) || desc.includes(keyword) || cat.includes(keyword)) ? '' : 'none';
    });

    // Pesan kosong
    let emptyMsg = document.getElementById('search-empty');
    const visible = [...produkCards].filter(c => c.style.display !== 'none');

    if (visible.length === 0 && keyword !== '') {
      if (!emptyMsg) {
        emptyMsg = document.createElement('div');
        emptyMsg.id = 'search-empty';
        emptyMsg.style.cssText = 'text-align:center;padding:40px 0;color:var(--gray);width:100%';
        emptyMsg.innerHTML = `
          <i class="bi bi-search" style="font-size:2.5rem;color:var(--border)"></i>
          <p style="margin-top:12px;font-family:Montserrat,sans-serif;font-weight:700;color:var(--navy)">
            Produk tidak ditemukan
          </p>
          <p style="font-size:13px">Coba kata kunci lain atau 
            <a href="/produk" style="color:var(--orange);font-weight:600">lihat semua produk</a>
          </p>`;
        produkSection.querySelector('.row.gy-4').insertAdjacentElement('afterend', emptyMsg);
      } else {
        emptyMsg.style.display = '';
      }
    } else if (emptyMsg) {
      emptyMsg.style.display = 'none';
    }

    // Scroll ke section produk jika ada keyword
    if (keyword.length === 1) {
      produkSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });

  // Enter = redirect ke halaman produk dengan search
  searchInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && this.value.trim()) {
      window.location.href = '/produk?search=' + encodeURIComponent(this.value.trim());
    }
  });
</script>
</body>
</html>