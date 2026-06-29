<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - SINERGI FLOWINDO</title>

  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="{{ asset('assets/css/blog.css') }}" rel="stylesheet">
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
        <li><a href="/layanan">LAYANAN</a></li>
        <li><a href="/blog" class="active">BLOG</a></li>
      </ul>
    </nav>
    <a href="/contact" class="btn-contact">
      Hubungi Kami <i class="bi bi-arrow-right"></i>
    </a>
  </div>
</header>

<main class="main">

  {{-- ══ HERO ══ --}}
  <section class="blog-hero">
    <div class="blog-hero-bg" style="background-image: url('{{ asset('assets/img/contact-hero.webp') }}')"></div>
    <div class="blog-hero-inner">
      <div class="container-fluid container-xl">
        <div class="row justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="blog-cat-badge">Blog &amp; Artikel</span>
            <h1 class="blog-hero-title ">Insight &amp; Solusi Flow Meter</h1>
            <p class="blog-hero-desc">Artikel informatif seputar teknologi flow meter, tips pemilihan, aplikasi industri, dan solusi untuk kebutuhan pengukuran aliran.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ══ BLOG SECTION ══ --}}
  <section class="blog-section">
    <div class="container">
      <div class="row g-4">
        {{-- ── KONTEN UTAMA ── --}}
        <div class="col-lg-8">
          <div class="row g-3" id="blogGrid">
            {{-- Featured --}}
            @if($featuredBlog)
              <div class="col-md-5 blog-item"
                   data-kategori="{{ $featuredBlog->category->name ?? 'Umum' }}"
                   data-judul="{{ strtolower($featuredBlog->judul) }}"
                   data-aos="fade-up">
                <div class="blog-featured">
                  @if($featuredBlog->gambar)
                    <img src="{{ asset('storage/' . $featuredBlog->gambar) }}" alt="{{ $featuredBlog->judul }}">
                  @else
                    <div style="position:absolute;inset:0;background:#1a2a4a"></div>
                  @endif
                  <div class="blog-featured-overlay"></div>
                  <div class="blog-featured-body">
                    <div class="mb-2">
                      <span class="badge-tag badge-featured-pill">Featured</span>
                      <span class="badge-tag badge-cat-pill">{{ $featuredBlog->category->name ?? 'Umum' }}</span>
                    </div>
                    <div class="blog-featured-meta">
                      <span><i class="bi bi-calendar3"></i>
                        {{ ($featuredBlog->published_at ? \Carbon\Carbon::parse($featuredBlog->published_at) : $featuredBlog->created_at)->isoFormat('D MMM YYYY') }}
                      </span>
                    </div>
                    <h3>{{ $featuredBlog->judul }}</h3>
                    <p>{{ Str::limit(strip_tags($featuredBlog->konten), 110) }}</p>
                    <a href="{{ route('blog.detail', $featuredBlog->slug) }}" class="blog-read-link blog-read-link-white">
                      Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endif

            {{-- Grid 2×2 --}}
            <div class="col-md-7">
              <div class="row g-3 h-100">
                @php $count = 0; @endphp
                @foreach($blog as $item)
                  @if($featuredBlog && $item->id === $featuredBlog->id) @continue @endif
                  @if($count >= 4) @break @endif
                  <div class="col-6 blog-item"
                       data-kategori="{{ $item->category->name ?? 'Umum' }}"
                       data-judul="{{ strtolower($item->judul) }}"
                       data-aos="fade-up"
                       data-aos-delay="{{ $count * 80 }}">
                    <div class="blog-card">
                      <div class="blog-card-img">
                        @if($item->gambar)
                          <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                          <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-image" style="font-size:36px;color:#ccc"></i>
                          </div>
                        @endif
                        <div class="card-overlay-row">
                          <span class="badge-cat-solid" title="{{ $item->category->name ?? 'Umum' }}">{{ $item->category->name ?? 'Umum' }}</span>
                          <span class="card-date-badge">
                            <i class="bi bi-calendar3"></i>
                            {{ ($item->published_at ? \Carbon\Carbon::parse($item->published_at) : $item->created_at)->isoFormat('D MMM YYYY') }}
                          </span>
                        </div>
                      </div>
                      <div class="blog-card-body">
                        <h4>{{ $item->judul }}</h4>
                        <a href="{{ route('blog.detail', $item->slug) }}" class="blog-read-link blog-read-link-orange">
                          Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  @php $count++; @endphp
                @endforeach
              </div>
            </div>

          </div>{{-- /row blogGrid --}}

          {{-- Sisa artikel --}}
          @php
            $skip      = $featuredBlog ? [$featuredBlog->id] : [];
            $remaining = $blog->filter(fn($i) => !in_array($i->id, $skip))->slice(4);
          @endphp
          @if($remaining->count())
            <div class="row g-3 mt-1">
              @foreach($remaining as $item)
                <div class="col-md-4 blog-item"
                     data-kategori="{{ $item->category->name ?? 'Umum' }}"
                     data-judul="{{ strtolower($item->judul) }}"
                     data-aos="fade-up">
                  <div class="blog-card">
                    <div class="blog-card-img">
                      @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                      @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                          <i class="bi bi-image" style="font-size:36px;color:#ccc"></i>
                        </div>
                      @endif
                      <div class="card-overlay-row">
                        <span class="badge-cat-solid" title="{{ $item->category->name ?? 'Umum' }}">{{ $item->category->name ?? 'Umum' }}</span>
                        <span class="card-date-badge">
                          <i class="bi bi-calendar3"></i>
                          {{ ($item->published_at ? \Carbon\Carbon::parse($item->published_at) : $item->created_at)->isoFormat('D MMM YYYY') }}
                        </span>
                      </div>
                    </div>
                    <div class="blog-card-body">
                      <h4>{{ $item->judul }}</h4>
                      <a href="{{ route('blog.detail', $item->slug) }}" class="blog-read-link blog-read-link-orange">
                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          {{-- Empty state --}}
          <div id="emptyState" class="text-center py-5 text-muted">
            <i class="bi bi-search" style="font-size:40px;opacity:.3"></i>
            <p class="mt-3 fw-semibold">Artikel tidak ditemukan.</p>
          </div>

          <div class="pagination-wrap">
            {{ $blog->links('pagination::bootstrap-4') }}
          </div>

        </div>{{-- /col-lg-8 --}}

        {{-- ── SIDEBAR ── --}}
        <div class="col-lg-4" data-aos="fade-left">

          <div class="sidebar-card">
            <div class="sidebar-title">Kategori</div>
            <div class="sidebar-line"></div>
            @foreach($categories->take(4) as $cat)
              <div class="sidebar-cat-item" data-filter="{{ $cat->name }}">
                <div class="cat-left">
                  <div class="cat-icon"><i class="bi bi-tag"></i></div>
                  <span class="cat-name">{{ $cat->name }}</span>
                </div>
                <span class="cat-count">{{ $cat->blogs_count }}</span>
              </div>
            @endforeach
            @if($categories->count() > 4)
              <button id="btnAllCategories" class="btn-lihat-semua mt-2">
                Lihat Semua Kategori <i class="bi bi-grid"></i>
              </button>
            @endif
          </div>

          <div class="sidebar-card">
            <div class="sidebar-title">Artikel Populer</div>
            <div class="sidebar-line"></div>
            @foreach($popularBlogs as $pop)
              <div class="sidebar-pop-item">
                <div class="sidebar-pop-img">
                  @if($pop->gambar)
                    <img src="{{ asset('storage/' . $pop->gambar) }}" alt="{{ $pop->judul }}">
                  @endif
                </div>
                <div>
                  <div class="sidebar-pop-date">
                    <i class="bi bi-calendar3"></i>
                    {{ ($pop->published_at ? \Carbon\Carbon::parse($pop->published_at) : $pop->created_at)->isoFormat('D MMM YYYY') }}
                  </div>
                  <a href="{{ route('blog.detail', $pop->slug) }}" class="sidebar-pop-title">
                    {{ Str::limit($pop->judul, 60) }}
                  </a>
                </div>
              </div>
            @endforeach
            <a href="/blog" class="btn-lihat-semua">Lihat Semua Artikel <i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>
    </div>
  </section>

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

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>
<div id="preloader"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
  AOS.init({ duration: 200, once: true });

  const BlogFilter = (() => {
    const tabs        = document.querySelectorAll('.filter-tab');
    const items       = document.querySelectorAll('.blog-item');
    const sidebarCats = document.querySelectorAll('.sidebar-cat-item');
    const searchInput = document.getElementById('searchInput');
    const searchBox   = document.getElementById('searchBox');
    const emptyState  = document.getElementById('emptyState');

    let activeFilter  = 'semua';
    let searchKeyword = '';

    function setActiveTab(filter) {
      tabs.forEach(t => t.classList.toggle('is-active', t.dataset.filter === filter));
    }

    function updateEmptyState() {
      const anyVisible = [...items].some(el => el.style.display !== 'none');
      if (emptyState) emptyState.style.display = anyVisible ? 'none' : 'block';
    }

    function applyAll() {
      items.forEach(item => {
        const matchFilter = activeFilter === 'semua' || item.dataset.kategori === activeFilter;
        const matchSearch = (item.dataset.judul || '').includes(searchKeyword);
        item.style.display = (matchFilter && matchSearch) ? '' : 'none';
      });
      updateEmptyState();
    }

    function setFilter(filter) {
      activeFilter = filter;
      setActiveTab(filter);
      applyAll();
    }

    function handleSearch() {
      searchKeyword = searchInput.value.toLowerCase().trim();
      searchBox?.classList.toggle('has-value', searchKeyword.length > 0);
      applyAll();
    }

    function init() {
      if (emptyState) emptyState.style.display = 'none';
      setActiveTab('semua');

      tabs.forEach(tab => tab.addEventListener('click', () => setFilter(tab.dataset.filter)));

      sidebarCats.forEach(el => el.addEventListener('click', () => {
        setFilter(el.dataset.filter);
        document.querySelector('.blog-section')?.scrollIntoView({ behavior: 'smooth' });
      }));

      searchInput?.addEventListener('input', handleSearch);
      searchInput?.addEventListener('keydown', e => {
        if (e.key === 'Escape') { searchInput.value = ''; handleSearch(); searchInput.blur(); }
      });
    }

    return { init, setFilter };
  })();

  BlogFilter.init();

  const KategoriModal = (() => {
    const backdrop   = document.getElementById('modalKategori');
    const btnOpen    = document.getElementById('btnAllCategories');
    const btnClose   = document.getElementById('btnCloseModal');
    const modalItems = document.querySelectorAll('.cat-modal-item');

    function open()  { backdrop?.classList.add('is-open');    document.body.style.overflow = 'hidden'; }
    function close() { backdrop?.classList.remove('is-open'); document.body.style.overflow = ''; }

    function init() {
      btnOpen?.addEventListener('click', open);
      btnClose?.addEventListener('click', close);
      backdrop?.addEventListener('click', e => { if (e.target === backdrop) close(); });
      document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
      modalItems.forEach(item => item.addEventListener('click', () => {
        BlogFilter.setFilter(item.dataset.filter);
        close();
        document.querySelector('.blog-section')?.scrollIntoView({ behavior: 'smooth' });
      }));
    }

    return { init };
  })();

  KategoriModal.init();
</script>

{{-- ══ MODAL SEMUA KATEGORI ══ --}}
<div id="modalKategori" class="cat-modal-backdrop">
  <div class="cat-modal">
    <div class="cat-modal-header">
      <div>
        <div class="cat-modal-title">Semua Kategori</div>
        <div class="cat-modal-sub">Pilih kategori untuk memfilter artikel</div>
      </div>
      <button id="btnCloseModal" class="cat-modal-close"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="cat-modal-body">
      @foreach($categories as $cat)
        <div class="cat-modal-item" data-filter="{{ $cat->name }}">
          <div class="cat-left">
            <div class="cat-icon"><i class="bi bi-tag"></i></div>
            <span class="cat-name">{{ $cat->name }}</span>
          </div>
          <span class="cat-count">{{ $cat->blogs_count }}</span>
        </div>
      @endforeach
    </div>
  </div>
</div>
</body>
</html>