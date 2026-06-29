<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $blog->judul }} - SINERGI FLOWINDO</title>
  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="{{ asset('assets/css/blog-detail.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
</head>
<body>

{{-- ══ HEADER ══ --}}
<header id="header" class="header sticky-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between py-3">
    <a href="/" class="text-decoration-none d-flex align-items-center gap-2">
      <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo" height="70">
      <div class="sitename">SINERGI FLOWINDO<small>Advanced Flow Measurement Solutions</small></div>
    </a>
    <nav class="navmenu d-none d-xl-block">
      <ul>
        <li><a href="/">HOME</a></li>
        <li><a href="/produk">PRODUK</a></li>
        <li><a href="/layanan">LAYANAN</a></li>
        <li><a href="/blog" class="active">BLOG</a></li>
      </ul>
    </nav>
    <a href="/contact" class="btn-konsultasi">Hubungi Kami <i class="bi bi-arrow-right"></i></a>
  </div>
</header>

<main class="main">
{{-- ══ HERO ══ --}}
<section class="hero">
  <div class="hero-bg-img" style="background-image:url('{{ asset('assets/img/detail-hero.webp') }}')"></div>
  <div class="hero-overlay"></div>
  <div class="hero-grid"></div>
  <div class="hero-blob"></div>
  <div class="hero-ring"></div>
  <div class="container hero-content">
    <div class="row">
      <div class="col-lg-7">
        <span class="hero-cat-badge">{{ $blog->category->name ?? 'Umum' }}</span>
        <h1 class="hero-title" style="font-size: clamp(28px, 4vw, 52px);">
          {{ $blog->judul }}
        </h1>
        <p class="hero-sub">{{ Str::limit(strip_tags($blog->konten), 140) }}</p>
        <div class="hero-meta-bar">
          <div class="hero-meta-item">
            <i class="bi bi-calendar3"></i>
            {{ $blog->published_at
                ? \Carbon\Carbon::parse($blog->published_at)->isoFormat('D MMM YYYY')
                : $blog->created_at->isoFormat('D MMM YYYY') }}
          </div>
          <div class="hero-meta-item">
            <i class="bi bi-person-circle"></i>
            {{ $blog->penulis ?? 'Tim Sinergi Flowindo' }}
          </div>
          @php
            $wordCount = str_word_count(strip_tags($blog->konten));
            $readTime  = max(1, ceil($wordCount / 200));
          @endphp
          <div class="hero-meta-item">
            <i class="bi bi-clock"></i>
            {{ $readTime }} menit baca
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ DETAIL SECTION ══ --}}
<section class="detail-section">
  <div class="container-fluid container-xl">
    <div class="row g-4">

      {{-- ── KONTEN UTAMA ── --}}
      <div class="col-lg-8">

        <div class="article-body" data-aos="fade-up">
          {!! $blog->konten !!}
          @if($blog->subJudul && $blog->subJudul->count() > 0)
            @foreach($blog->subJudul as $sub)
              <div class="artikel-content mt-4">
                <h2 style="font-size:1.4rem;font-weight:800;color:#1a1a2e;margin-bottom:12px;">
                  {{ $sub->sub_judul }}
                </h2>
                @if(!empty($sub->sub_konten))
                  <p>{{ $sub->sub_konten }}</p>
                @endif
              </div>
            @endforeach
          @endif
            </div>
        <div class="prevnext-bar" data-aos="fade-up">
          @if($prev)
            <a href="{{ route('blog.detail', $prev->slug) }}" class="prevnext-card">
              <div class="prevnext-label"><i class="bi bi-arrow-left"></i> Artikel Sebelumnya</div>
              <div class="prevnext-title">{{ Str::limit($prev->judul, 70) }}</div>
            </a>
          @else
            <div></div>
          @endif
          @if($next)
            <a href="{{ route('blog.detail', $next->slug) }}" class="prevnext-card" style="text-align:right">
              <div class="prevnext-label" style="justify-content:flex-end">Artikel Selanjutnya <i class="bi bi-arrow-right"></i></div>
              <div class="prevnext-title">{{ Str::limit($next->judul, 70) }}</div>
            </a>
          @else
            <div></div>
          @endif
        </div>

      </div>{{-- /col-lg-8 --}}

      {{-- ── SIDEBAR ── --}}
      <div class="col-lg-4" data-aos="fade-left">

        <div class="sidebar-card">
          <div class="sidebar-title">Artikel Populer</div>
          <div class="sidebar-line"></div>
          @foreach($recentBlogs as $pop)
            <div class="sidebar-pop-item">
              <div class="sidebar-pop-img">
                @if($pop->gambar)
                  <img src="{{ asset('storage/' . $pop->gambar) }}" alt="{{ $pop->judul }}">
                @endif
              </div>
              <div>
                <div class="sidebar-pop-date">
                  <i class="bi bi-calendar3"></i>
                  {{ $pop->published_at
                      ? \Carbon\Carbon::parse($pop->published_at)->isoFormat('D MMM YYYY')
                      : $pop->created_at->isoFormat('D MMM YYYY') }}
                </div>
                <a href="{{ route('blog.detail', $pop->slug) }}" class="sidebar-pop-title">{{ Str::limit($pop->judul, 58) }}</a>
              </div>
            </div>
          @endforeach
          <a href="/blog" class="btn-help btn-help-outline mt-3">
            Lihat Semua Artikel <i class="bi bi-arrow-right"></i>
          </a>
        </div>

        <div class="sidebar-card">
          <div class="sidebar-title">Kategori</div>
          <div class="sidebar-line"></div>
          @foreach($categories as $cat)
            <a href="/blog?kategori={{ $cat->name }}" class="sidebar-cat-item">
              <div class="cat-left">
                <div class="cat-icon"><i class="bi bi-tag"></i></div>
                <span class="cat-name">{{ $cat->name }}</span>
              </div>
              <span class="cat-count">{{ $cat->blogs_count }}</span>
            </a>
          @endforeach
        </div>

        <div class="sidebar-card">
          <div class="sidebar-title">Butuh Bantuan?</div>
          <p style="font-size:13px;color:var(--gray);margin-bottom:12px">Konsultasi dengan ahli kami sekarang juga.</p>
          <div class="sidebar-help-item"><i class="bi bi-check-circle-fill"></i> Gratis Konsultasi</div>
          <div class="sidebar-help-item"><i class="bi bi-check-circle-fill"></i> Rekomendasi Produk</div>
          <div class="sidebar-help-item"><i class="bi bi-check-circle-fill"></i> Solusi Sesuai Kebutuhan</div>
          <a href="/contact" class="btn-help">Konsultasi Sekarang <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ══ ARTIKEL TERKAIT ══ --}}
<section class="related-section">
  <div class="container-fluid container-xl">
    <div class="section-heading" data-aos="fade-up">
      <h2>Artikel Terkait</h2>
      <div class="line"></div>
    </div>
    <div class="row g-3">
      @foreach($recentBlogs as $rel)
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="related-card">
            <div class="related-card-img">
              @if($rel->gambar)
                <img src="{{ asset('storage/' . $rel->gambar) }}" alt="{{ $rel->judul }}">
              @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center">
                  <i class="bi bi-image" style="font-size:40px;color:#ccc"></i>
                </div>
              @endif
              <div class="related-card-overlay">
                <span class="badge-cat">{{ $rel->category->name ?? 'Umum' }}</span>
                <span class="badge-date">
                  <i class="bi bi-calendar3"></i>
                  {{ $rel->published_at
                      ? \Carbon\Carbon::parse($rel->published_at)->isoFormat('D MMM YYYY')
                      : $rel->created_at->isoFormat('D MMM YYYY') }}
                </span>
              </div>
            </div>
            <div class="related-card-body">
              <h3>{{ $rel->judul }}</h3>
              <a href="{{ route('blog.detail', $rel->slug) }}" class="related-read-link">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 200, once: true });

  /* ════════════════════════════════════════
     TOC Scroll Spy
     Tambahkan class .is-active ke li yang sedang aktif.
     CSS mengatur tampilannya (.is-active > a { color: orange })
  ════════════════════════════════════════ */
  const TocSpy = (() => {
    const tocItems = document.querySelectorAll('#tocList li');
    if (!tocItems.length) return;

    const sections = Array.from(tocItems).map(li => {
      const href = li.querySelector('a')?.getAttribute('href');
      return href ? document.querySelector(href) : null;
    });

    let currentIndex = 0;

    function update() {
      let next = 0;
      sections.forEach((sec, i) => {
        if (sec && sec.getBoundingClientRect().top < 160) next = i;
      });

      if (next !== currentIndex) {
        tocItems[currentIndex]?.classList.remove('is-active');
        tocItems[next]?.classList.add('is-active');
        currentIndex = next;
      }
    }

    window.addEventListener('scroll', update, { passive: true });
    update(); // set initial state
  })();

  /* ════════════════════════════════════════
     Newsletter — basic UX feedback
  ════════════════════════════════════════ */
  const Newsletter = (() => {
    const input = document.getElementById('newsletterEmail');
    const btn   = document.getElementById('newsletterBtn');
    if (!input || !btn) return;

    btn.addEventListener('click', () => {
      const email = input.value.trim();
      if (!email || !email.includes('@')) {
        input.style.borderColor = '#e74c3c';
        input.focus();
        return;
      }
      input.style.borderColor = '#25d366';
      btn.innerHTML = '<i class="bi bi-check-lg"></i>';
      btn.disabled = true;
    });

    input.addEventListener('input', () => {
      input.style.borderColor = '';
    });
  })();
</script>

</body>
</html>