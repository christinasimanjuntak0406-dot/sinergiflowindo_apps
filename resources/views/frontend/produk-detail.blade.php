<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $produk->nama_produk }} - SINERGI FLOWINDO</title>
  <link rel="canonical" href="{{ url()->current() }}">

  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/produk-detail.css') }}" rel="stylesheet">
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
        <li><a href="/produk" class="active">PRODUK</a></li>
        <li><a href="/layanan">LAYANAN</a></li>
        <li><a href="/blog">BLOG</a></li>
      </ul>
    </nav>
    <a href="/contact" class="btn-getstarted">Hubungi Kami</a>
  </div>
</header>

{{-- ══ BREADCRUMB ══ --}}
<div class="breadcrumb-section">
  <div class="container">
    <ol>
      <li><a href="/">Home</a></li>
      <li><a href="/produk">Produk</a></li>
      <li class="active">{{ $produk->nama_produk }}</li>
    </ol>
  </div>
</div>

{{-- ══ DETAIL ══ --}}
<section class="detail-section">
  <div class="container">
    <div class="row g-5">

      {{-- Gallery --}}
      <div class="col-lg-6" data-aos="fade-right">
        <div class="gallery-wrap">
          <div class="gallery-thumbs" id="thumbList">
            @if($produk->gambar)
            <div class="thumb-item is-active" data-src="{{ asset('uploads/produk/' . $produk->gambar) }}">
              <img src="{{ asset('uploads/produk/' . $produk->gambar) }}" alt="">
            </div>
            @endif
            @if($produk->gambar2)
            <div class="thumb-item" data-src="{{ asset('uploads/produk/' . $produk->gambar2) }}">
              <img src="{{ asset('uploads/produk/' . $produk->gambar2) }}" alt="">
            </div>
            @endif
            @if($produk->gambar3)
            <div class="thumb-item" data-src="{{ asset('uploads/produk/' . $produk->gambar3) }}">
              <img src="{{ asset('uploads/produk/' . $produk->gambar3) }}" alt="">
            </div>
            @endif
            @if($produk->gambar4)
            <div class="thumb-item" data-src="{{ asset('uploads/produk/' . $produk->gambar4) }}">
              <img src="{{ asset('uploads/produk/' . $produk->gambar4) }}" alt="">
            </div>
            @endif
          </div>

          <div class="gallery-main">
            <img id="mainImg"
              src="{{ asset('uploads/produk/' . $produk->gambar) }}"
              alt="{{ $produk->nama_produk }}">
            <button class="gallery-zoom" id="btnZoom">
              <i class="bi bi-arrows-fullscreen"></i> Perbesar
            </button>
          </div>
        </div>

        @if(!empty($produk->gallery_badges))
        <div class="gallery-badges">
          @foreach($produk->gallery_badges as $badge)
          <div class="gallery-badge-item">
            <i class="{{ $badge['icon'] }} badge-icon"></i>
            <span>{{ $badge['label'] }}</span>
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- Product Info --}}
      <div class="col-lg-6" data-aos="fade-left">
        <div class="product-info">
          <h2 class="product-title">{{ $produk->nama_produk }}</h2>
          <p class="product-short-desc">{{ $produk->deskripsi_singkat ?? strip_tags($produk->deskripsi) }}</p>

          <div class="product-highlights">
            @forelse($produk->highlight_tags ?? [] as $tag)
            <span class="highlight-tag"><i class="{{ $tag['icon'] }}"></i> {{ $tag['label'] }}</span>
            @empty
            @endforelse
          </div>

          <div class="info-divider"></div>

          @php $spekSlice = array_slice($produk->spesifikasi_json ?? [], 0, 4); @endphp
          @if(!empty($spekSlice))
          <div class="specs-grid">
            @foreach($spekSlice as $spek)
            <div class="spec-item">
              <label>{{ $spek['key'] }}</label>
              <span>{{ $spek['value'] }}</span>
            </div>
            @endforeach
          </div>
          @endif

          <div class="cta-buttons">
            <a href="https://wa.me/6281265871759?text={{ urlencode('Halo, saya tertarik dengan produk ' . $produk->nama_produk) }}"
              class="btn-whatsapp" target="_blank">
              <i class="bi bi-whatsapp"></i> Chat WhatsApp
            </a>
            @if($produk->datasheet_file)
            <a href="{{ asset('uploads/datasheet/' . $produk->datasheet_file) }}"
              class="btn-datasheet" target="_blank" download>
              <i class="bi bi-file-earmark-pdf"></i> Unduh Katalog
            </a>
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ══ KEUNGGULAN & SPESIFIKASI ══ --}}
<section class="detail-bottom" id="spesifikasi">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-6" data-aos="fade-up">
        <div class="detail-card">
          <h3 class="detail-card-title">Keunggulan Produk</h3>
          <div class="detail-card-line"></div>
          <p class="keunggulan-desc">{{ $produk->deskripsi }}</p>
          <ul class="keunggulan-list">
            @forelse($produk->keunggulan_list ?? [] as $poin)
            <li><i class="bi bi-check-circle-fill"></i> {{ $poin }}</li>
            @empty
            <li><i class="bi bi-check-circle-fill"></i> -</li>
            @endforelse
          </ul>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="detail-card">
          <h3 class="detail-card-title">Spesifikasi Teknis</h3>
          <div class="detail-card-line"></div>
          @php $allSpek = $produk->getAllSpesifikasi(); @endphp
          @if(!empty($allSpek))
          <table class="spek-table">
            @foreach($allSpek as $spek)
            <tr><td>{{ $spek['key'] }}</td><td>{{ $spek['value'] }}</td></tr>
            @endforeach
          </table>
          @else
          <p style="color: var(--gray); font-size: 14px;">Spesifikasi belum tersedia.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ APLIKASI ══ --}}
<section class="aplikasi-section">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-3" data-aos="fade-right">
        <p class="sec-title">Aplikasi Penggunaan</p>
        <div class="sec-line"></div>
        <p class="sec-desc">Cocok digunakan di berbagai industri dan sistem pengolahan cairan.</p>
      </div>
      <div class="col-lg-9" data-aos="fade-left">
        <div class="aplikasi-grid">
          @forelse($produk->aplikasi_list ?? [] as $app)
          <div class="aplikasi-item">
            <i class="{{ $app['icon'] }}"></i>
            <span>{{ $app['label'] }}</span>
          </div>
          @empty
          <p style="color: rgba(255,255,255,.5); font-size: 14px;">Belum ada data aplikasi.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ PRODUK TERKAIT ══ --}}
@if($produkTerkait->count() > 0)
<section class="terkait-section">
  <div class="container">
    <h3 class="sec-title">Produk Terkait</h3>
    <div class="sec-line"></div>
    <div class="row g-4">
      @foreach($produkTerkait as $item)
      <div class="col-lg-3 col-md-6" data-aos="fade-up">
        <div class="terkait-card">
          <div class="terkait-img">
            <img src="{{ asset('uploads/produk/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
          </div>
          <div class="terkait-body">
            <div class="terkait-cat">{{ $item->category->name ?? 'Flow Meter' }}</div>
            <h5>{{ $item->nama_produk }}</h5>
            <a href="{{ route('produk.detail', $item->slug) }}" class="terkait-link">
              Lihat Detail <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ══ LIGHTBOX ══ --}}
<div class="lightbox-overlay" id="lightbox">
  <button class="lightbox-close" id="btnLightboxClose">&times;</button>
  <img id="lightboxImg" src="" alt="">
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
  AOS.init({ duration: 200, once: true });

  // ── Gallery ──
  const Gallery = {
    mainImg  : document.getElementById('mainImg'),
    thumbs   : document.querySelectorAll('.thumb-item'),
    btnZoom  : document.getElementById('btnZoom'),

    init() {
      this.thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => this.switchTo(thumb));
      });
      this.btnZoom.addEventListener('click', () => {
        Lightbox.open(this.mainImg.src);
      });
    },

    switchTo(thumb) {
      this.mainImg.src = thumb.dataset.src;
      this.thumbs.forEach(t => t.classList.remove('is-active'));
      thumb.classList.add('is-active');
    }
  };

  // ── Lightbox ──
  const Lightbox = {
    overlay  : document.getElementById('lightbox'),
    img      : document.getElementById('lightboxImg'),
    btnClose : document.getElementById('btnLightboxClose'),

    init() {
      this.btnClose.addEventListener('click', () => this.close());
      this.overlay.addEventListener('click', e => {
        if (e.target === this.overlay) this.close();
      });
      document.addEventListener('keydown', e => {
        if (e.key === 'Escape') this.close();
      });
    },

    open(src) {
      this.img.src = src;
      this.overlay.classList.add('is-open');
    },

    close() {
      this.overlay.classList.remove('is-open');
    }
  };

  // ── Init ──
  Gallery.init();
  Lightbox.init();
</script>
</body>
</html>