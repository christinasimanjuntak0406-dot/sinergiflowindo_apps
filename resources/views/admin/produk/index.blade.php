@extends('admin.layout.app')
@section('title', 'Kelola Produk')
@section('content')
  <link href="{{ asset('assets/css/kelola_produk.css') }}" rel="stylesheet">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif
    {{-- ── TOOLBAR ── --}}
    <div class="produk-toolbar">
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Produk
        </a>

        {{-- Filter / Search --}}
        <form method="GET" action="{{ route('admin.produk.index') }}" class="produk-filter-form">
            <select name="category_id" class="form-control form-control-sm" style="min-width:150px;" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="form-control form-control-sm" style="min-width:120px;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <div class="input-group input-group-sm">
                <input type="text" name="q" class="form-control" placeholder="Cari nama / model…" value="{{ request('q') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>

            @if(request()->hasAny(['q','category_id','status']))
                <a href="{{ route('admin.produk.index') }}" class="btn btn-sm btn-outline-danger" title="Reset filter">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title mb-0">Daftar Produk</h3>
            <small class="text-muted">{{ $produk->total() }} produk ditemukan</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0 produk-table">
                <thead class="thead-light">
                    <tr>
                        <th width="40">#</th>
                        <th width="70">Foto</th>
                        <th>Nama Produk</th>
                        <th width="140">Kategori</th>
                        <th>Deskripsi Singkat</th>
                        <th width="80" class="text-center">Status</th>
                        <th width="130" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $item)
                    <tr>
                        <td class="text-muted" style="font-size:12px;">
                            {{ ($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration }}
                        </td>

                        {{-- FOTO --}}
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('uploads/produk/' . $item->gambar) }}" class="produk-thumb">
                            @else
                                <div class="produk-thumb-placeholder">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>

                        {{-- NAMA + meta --}}
                        <td>
                            <span class="produk-nama">{{ $item->nama_produk }}</span>

                            <div class="produk-meta">
                                @if($item->model_number)
                                    <span class="badge"><i class="fas fa-barcode"></i>{{ $item->model_number }}</span>
                                @endif
                                @if(!empty($item->highlight_specs) && count($item->highlight_specs))
                                    <span class="badge"><i class="fas fa-chart-bar"></i>{{ count($item->highlight_specs) }} stats</span>
                                @endif
                                @if(!empty($item->getAllSpesifikasi()) && count($item->getAllSpesifikasi()))
                                    <span class="badge"><i class="fas fa-list-ul"></i>{{ count($item->getAllSpesifikasi()) }} spek</span>
                                @endif
                                @if($item->datasheet_file)
                                    <span class="badge"><i class="fas fa-file-pdf text-danger"></i>PDF</span>
                                @endif
                                @if($item->video_url)
                                    <span class="badge"><i class="fab fa-youtube text-danger"></i>Video</span>
                                @endif
                            </div>

                            @if($item->slug)
                                <div class="produk-slug mt-1">/{{ $item->slug }}</div>
                            @endif
                        </td>

                        {{-- KATEGORI --}}
                        <td>
                            <span class="produk-kategori-badge">{{ $item->category->name ?? '-' }}</span>
                        </td>

                        {{-- DESKRIPSI --}}
                        <td style="font-size:13px;">
                            {{ Str::limit($item->deskripsi_singkat ?? $item->deskripsi ?? '-', 70) }}
                        </td>

                        {{-- STATUS --}}
                        <td class="text-center">
                            @if($item->status_aktif)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-secondary">Nonaktif</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="produk-aksi">
                                <a href="{{ url('/produk/' . $item->slug) }}" target="_blank"
                                   class="btn btn-sm btn-outline-info" title="Lihat di frontend">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.produk.edit', $item->id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.produk.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm({{ Js::from('Yakin hapus produk "' . $item->nama_produk . '"?') }})">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                            @if(request()->hasAny(['q','category_id','status']))
                                Tidak ada produk yang cocok dengan filter.
                                <a href="{{ route('admin.produk.index') }}">Reset filter</a>
                            @else
                                Belum ada produk. <a href="{{ route('admin.produk.create') }}">Tambah sekarang</a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
        @if($produk->hasPages())
        <div class="card-footer">
           {{ $produk->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>

@endsection