<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk - SINERGI FLOWINDO</title>

  <link href="{{ asset('assets/img/logo.webp') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/produk.css') }}" rel="stylesheet">
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
        <li><a href="/produk" class="active">PRODUK</a></li>
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
          <span class="produk-cat-badge">Produk Kami</span>
        <h1 class="hero-title">Distributor Flow Meter</h1>
        <p class="hero-sub mx-auto">
          Solusi Pengukuran aliran untuk air, solar, bahan kimia, gas, dan berbagai kebutuhan industri dengan akurasi tinggi.
        </p>
        <div class="hero-meta-bar justify-content-center">
          <div class="hero-meta-item"><i class="bi bi-shield-fill-check"></i> Kualitas Terjamin</div>
          <div class="hero-meta-item"><i class="bi bi-patch-check-fill"></i> Bergaransi Resmi</div>
          <div class="hero-meta-item"><i class="bi bi-lightning-fill"></i> Pengiriman Cepat</div>
        </div>
      </div>
    </div>
  </div>
  </section>
  {{-- ══ LAYOUT ══ --}}
  <div class="produk-layout">
    <div class="container-fluid container-xl">
      <button class="sidebar-toggle d-lg-none" id="sidebarToggle">
        <i class="bi bi-layout-sidebar"></i>
        <span>Kategori Produk</span>
        <i class="bi bi-chevron-down ms-auto" id="toggleIcon"></i>
      </button>
      <div class="produk-layout-inner">
        {{-- ══ SIDEBAR ══ --}}
        <aside class="sidebar" id="sidebar">
          <div class="sidebar-card">
            <div class="sidebar-header">
              <h6>Kategori</h6>
            </div>
            <div class="cat-list">
              <div class="cat-item cat-accordion" data-filter="semua">
                <div class="cat-header">
                  <span class="cat-item-name">Semua Produk</span>
                  <span class="cat-item-count">{{ $produk->count() }}</span>
                  <i class="bi bi-chevron-down cat-chevron"></i>
                </div>
                <div class="cat-produk-list">
                  @foreach($produk as $item)
                  <a href="{{ route('produk.detail', $item->slug) }}" class="cat-produk-item">
                    <i class="bi bi-dash-lg"></i>
                    {{ $item->nama_produk }}
                  </a>
                  @endforeach
                </div>
              </div>
              @foreach($categories as $cat)
             <div class="cat-item cat-accordion" data-filter="{{ $cat->name }}">
              <div class="cat-header">
                 <span class="cat-item-name">{{ $cat->name }}</span>
                  <span class="cat-item-count">{{ $produk->where('category.name', $cat->name)->count() }}</span>
                  <i class="bi bi-chevron-down cat-chevron"></i>
              </div>  
              <div class="cat-produk-list">
                @foreach($produk->where('category.name', $cat->name) as $item)
                <a href="{{ route('produk.detail', $item->slug) }}" class="cat-produk-item">
                  <i class="bi bi-dash-lg"></i>
                  {{ $item->nama_produk }}
                </a>
                @endforeach
              </div>
             </div>
              @endforeach
            </div>
          </div>
        </aside>
        {{-- ══ CONTENT ══ --}}
        <div class="content-area">
          <div class="content-toolbar">
            <div class="toolbar-left">
              <span class="result-text">Menampilkan <strong id="resultCount">{{ $produk->count() }}</strong> produk</span>
              <span class="active-cat-badge" id="activeBadge">
                <i class="bi bi-funnel-fill"></i>
                <span id="activeBadgeName"></span>
                <button onclick="ProductFilter.reset()"><i class="bi bi-x"></i></button>
              </span>
            </div>
            <div class="toolbar-search">
              <i class="bi bi-search"></i>
              <input type="text" id="searchInput" placeholder="Cari produk...">
              <button class="btn-clear-search" id="btnClear"><i class="bi bi-x"></i></button>
            </div>
          </div>
          <div class="row g-4" id="productGrid">
            @foreach($produk as $item)
              <div class="col-xl-4 col-md-6 product-item"
                   data-kategori="{{ $item->category->name ?? '' }}"
                   data-nama="{{ strtolower($item->nama_produk) }}"
                   data-desc="{{ strtolower(strip_tags($item->deskripsi)) }}">
                <div class="product-card">
                  <div class="product-image">
                    <img src="{{ asset('uploads/produk/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" loading="lazy">
                  </div>
                  <div class="product-body">
                    <div class="product-category">{{ $item->category->name ?? 'Flow Meter' }}</div>
                    <h4>{{ $item->nama_produk }}</h4>
                    <p>{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                    <a href="{{ route('produk.detail', $item->slug) }}" class="product-btn">
                      Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="empty-state" id="emptyState">
            <i class="bi bi-box-seam"></i>
            <h5>Produk Tidak Ditemukan</h5>
            <p>Coba kata kunci lain atau pilih kategori yang berbeda</p>
            <button class="btn-reset" onclick="ProductFilter.reset()">
              <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script>
  AOS.init({ duration: 200, once: true });

  // ── Sidebar Mobile Toggle ──
  const SidebarToggle = {
    btn     : document.getElementById('sidebarToggle'),
    sidebar : document.getElementById('sidebar'),
    icon    : document.getElementById('toggleIcon'),

    init() {
      this.btn?.addEventListener('click', () => this.toggle());
    },
    toggle() {
      const open = this.sidebar.classList.toggle('is-open');
      this.icon.className = open ? 'bi bi-chevron-up ms-auto' : 'bi bi-chevron-down ms-auto';
    },
    close() {
      this.sidebar.classList.remove('is-open');
      this.icon.className = 'bi bi-chevron-down ms-auto';
    }
  };

  // ── Product Filter & Search ──
  const ProductFilter = {
    activeFilter : 'semua',
    items        : document.querySelectorAll('.product-item'),
    catItems     : document.querySelectorAll('.cat-item'),
    searchInput  : document.getElementById('searchInput'),
    btnClear     : document.getElementById('btnClear'),
    resultCount  : document.getElementById('resultCount'),
    emptyState   : document.getElementById('emptyState'),
    activeBadge  : document.getElementById('activeBadge'),
    activeBadgeName: document.getElementById('activeBadgeName'),

    init() {
      this.catItems.forEach(c => {
        const header = c.querySelector('.cat-header') ?? c;
        header.addEventListener('click', () => {
          if (c.classList.contains('cat-accordion')) {
            const isOpen = c.classList.contains('is-active');

            // Tutup semua accordion
            document.querySelectorAll('.cat-accordion.is-active').forEach(el => {
              el.classList.remove('is-active');
            });

            if (!isOpen) {
              c.classList.add('is-active');
              this.setFilter(c.dataset.filter);
            } else {
              c.classList.remove('is-active');
            }

            // Mobile: scroll ke produk grid setelah pilih kategori
            if (window.innerWidth < 992) {
              setTimeout(() => {
                document.querySelector('.content-area')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
              }, 300);
            }
          }
        });
      });

      this.searchInput.addEventListener('input', () => {
        const hasValue = this.searchInput.value.length > 0;
        this.btnClear.classList.toggle('is-visible', hasValue);
        this.apply();
      });

      this.btnClear.addEventListener('click', () => {
        this.searchInput.value = '';
        this.btnClear.classList.remove('is-visible');
        this.apply();
        this.searchInput.focus();
      });
    },

    setFilter(value) {
      this.activeFilter = value;

      this.catItems.forEach(c => {
        if (!c.classList.contains('cat-accordion')) {
          c.classList.toggle('is-active', c.dataset.filter === value);
        }
      });

      const isFiltered = value !== 'semua';
      this.activeBadge.classList.toggle('is-visible', isFiltered);
      if (isFiltered) this.activeBadgeName.textContent = value;

      this.apply();
    },

    apply() {
      const keyword = this.searchInput.value.trim().toLowerCase();
      let visible = 0;

      this.items.forEach(item => {
        const matchFilter = this.activeFilter === 'semua' || item.dataset.kategori === this.activeFilter;
        const matchSearch = !keyword || item.dataset.nama.includes(keyword) || item.dataset.desc.includes(keyword);
        const show = matchFilter && matchSearch;

        item.classList.toggle('is-hidden', !show);
        if (show) visible++;
      });

      this.resultCount.textContent = visible;
      this.emptyState.classList.toggle('is-visible', visible === 0);
    },

    reset() {
      this.searchInput.value = '';
      this.btnClear.classList.remove('is-visible');
      document.querySelectorAll('.cat-accordion.is-active').forEach(el => el.classList.remove('is-active'));
      this.activeFilter = 'semua';
      this.activeBadge.classList.remove('is-visible');
      this.apply();
    }
  };
  SidebarToggle.init();
  ProductFilter.init();
</script>
</body>
</html>