@extends('admin.layout.app')
@section('title', '')
@section('content')
 <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    <h2 class="mb-4">Company Dashboard</h2>

    {{-- ── STAT CARDS ── --}}
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-blue"><i class="fas fa-box"></i></div>
                <div>
                    <div class="stat-value">{{ $totalProduk }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-purple"><i class="fas fa-tags"></i></div>
                <div>
                    <div class="stat-value">{{ $totalKategori }}</div>
                    <div class="stat-label">Total Kategori</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-green"><i class="fas fa-concierge-bell"></i></div>
                <div>
                    <div class="stat-value">{{ $totalLayanan }}</div>
                    <div class="stat-label">Total Layanan</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-orange"><i class="fas fa-newspaper"></i></div>
                <div>
                    <div class="stat-value">{{ $totalBlog }}</div>
                    <div class="stat-label">Total Artikel Blog</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-red"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="stat-value">{{ $pesanBelumDibaca }}</div>
                    <div class="stat-label">Pesan Belum Dibaca</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-blue"><i class="fas fa-inbox"></i></div>
                <div>
                    <div class="stat-value">{{ $totalPesan }}</div>
                    <div class="stat-label">Total Pesan Masuk</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- ── PESAN MASUK TERBARU ── --}}
        <div class="col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Pesan Masuk Terbaru</h3>
                    @if(Route::has('admin.pesan-kontak.index'))
                        <a href="{{ route('admin.pesan-kontak.index') }}" class="small">Lihat semua</a>
                    @endif
                </div>
                <div class="card-body">
                    @forelse($pesanTerbaru as $p)
                        <div class="recent-item">
                            <div class="recent-avatar">
                                {{ strtoupper(substr($p->nama ?? $p->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <div class="recent-title">{{ $p->nama ?? $p->name ?? 'Tanpa nama' }}</div>
                                <div class="recent-sub">
                                    {{ $p->email ?? '-' }} &middot;
                                    {{ Str::limit($p->pesan ?? $p->message ?? $p->subjek ?? '-', 50) }}
                                </div>
                            </div>
                            <div class="recent-time">
                                @if($p->created_at)
                                    {{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-mini">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada pesan masuk.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ── QUICK LINKS ── --}}
        <div class="col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title mb-0">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column" style="gap:10px;">
                        @if(Route::has('admin.produk.create'))
                            <a href="{{ route('admin.produk.create') }}" class="quick-link">
                                <i class="fas fa-plus-circle"></i> Tambah Produk
                            </a>
                        @endif
                        @if(Route::has('admin.blog.create'))
                            <a href="{{ route('admin.blog.create') }}" class="quick-link">
                                <i class="fas fa-pen"></i> Tulis Artikel Blog
                            </a>
                        @endif
                        @if(Route::has('admin.layanan.create'))
                            <a href="{{ route('admin.layanan.create') }}" class="quick-link">
                                <i class="fas fa-plus-circle"></i> Tambah Layanan
                            </a>
                        @endif
                        @if(Route::has('admin.categories.create'))
                            <a href="{{ route('admin.categories.create') }}" class="quick-link">
                                <i class="fas fa-tag"></i> Tambah Kategori
                            </a>
                        @endif
                        @if(Route::has('admin.produk.index'))
                            <a href="{{ route('admin.produk.index') }}" class="quick-link">
                                <i class="fas fa-list"></i> Kelola Semua Produk
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection