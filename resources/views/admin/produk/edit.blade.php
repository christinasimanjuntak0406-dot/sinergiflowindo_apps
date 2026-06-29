@extends('admin.layout.app')
@section('title', 'Edit Produk')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit Produk — {{ $produk->nama_produk }}</h3>
    </div>
    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">

            {{-- ── INFORMASI DASAR ── --}}
            <h5 class="mb-3 mt-2 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Informasi Dasar</h5>

            <div class="form-group">
                <label>Nama Produk <span class="text-danger">*</span></label>
                <input type="text" name="nama_produk" class="form-control"
                    value="{{ old('nama_produk', $produk->nama_produk) }}" required>
            </div>
            {{-- Tambahkan setelah form-group nama_produk --}}
            <div class="form-group">
                <label>
                    Slug <span class="text-danger">*</span>
                    <small class="text-muted ml-1">(URL produk: /produk/<strong id="slug-preview">{{ old('slug', $produk->slug) }}</strong>)</small>
                </label>
                <div class="input-group">
                    <input type="text" name="slug" id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $produk->slug) }}"
                        required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="btn-generate-slug"
                            title="Generate otomatis dari nama produk">
                            <i class="fas fa-sync-alt"></i> Generate
                        </button>
                    </div>
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <small class="text-muted">Huruf kecil, angka, dan tanda hubung saja. Harus unik.</small>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $produk->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" class="form-control" rows="2"
                    placeholder="Tampil di listing / card produk">{{ old('deskripsi_singkat', $produk->deskripsi_singkat) }}</textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi Lengkap</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status_aktif" class="form-control">
                    <option value="1" {{ old('status_aktif', $produk->status_aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status_aktif', $produk->status_aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <hr>

            {{-- ── GALLERY / FOTO ── --}}
            <h5 class="mb-3 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Gallery Foto</h5>
            <div class="row">
                @foreach(['gambar' => 'Foto Utama', 'gambar2' => 'Foto 2', 'gambar3' => 'Foto 3', 'gambar4' => 'Foto 4'] as $field => $label)
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ $label }}</label>
                        @if($produk->$field)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/produk/' . $produk->$field) }}"
                                    height="80" alt="{{ $label }}"
                                    style="border-radius:6px;object-fit:cover;width:100%;">
                            </div>
                        @endif
                        <input type="file" name="{{ $field }}" class="form-control" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti.</small>
                    </div>
                </div>
                @endforeach
            </div>

            <hr>

            {{-- ── DATASHEET ── --}}
            <h5 class="mb-3 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Datasheet</h5>
            <div class="form-group">
                <label>File Datasheet (PDF)</label>
                @if($produk->datasheet_file)
                    <div class="mb-2">
                        <a href="{{ asset('uploads/datasheet/' . $produk->datasheet_file) }}"
                            target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-file-pdf mr-1"></i> Lihat Datasheet Saat Ini
                        </a>
                    </div>
                @endif
                <input type="file" name="datasheet_file" class="form-control" accept=".pdf">
                <small class="text-muted">Upload PDF baru untuk mengganti. Kosongkan jika tidak ingin mengganti. Tombol download hanya muncul jika file terisi.</small>
            </div>

            <hr>

            {{-- ── HIGHLIGHT TAGS ── --}}
            <h5 class="mb-1 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Highlight Tags</h5>
            <small class="text-muted d-block mb-3">Tag kecil di bawah nama produk (contoh: Akurasi ±0.5%, Rentang Lebar).</small>

            <div id="highlight-tags-wrapper">
                @php $htItems = old('ht_label') ? [] : ($produk->highlight_tags ?? []); @endphp
    @if(old('ht_label'))
        @foreach(old('ht_label') as $i => $label)
        <div class="row mb-2 highlight-tag-row">
            <div class="col-md-11">
                <input type="text" name="ht_label[]" class="form-control" value="{{ $label }}" placeholder="Label tag">
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
            </div>
        </div>
        @endforeach
    @else
        @forelse($htItems as $item)
        <div class="row mb-2 highlight-tag-row">
            <div class="col-md-11">
                <input type="text" name="ht_label[]" class="form-control" value="{{ $item['label'] ?? '' }}" placeholder="Label tag">
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
            </div>
        </div>
        @empty
        <div class="row mb-2 highlight-tag-row">
            <div class="col-md-11"><input type="text" name="ht_label[]" class="form-control" placeholder="Label tag"></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        </div>
        @endforelse
        @endif
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-highlight-tag">+ Tambah Tag</button>

            <hr>

            {{-- ── KEUNGGULAN ── --}}
            <h5 class="mb-1 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Poin Keunggulan</h5>
            <small class="text-muted d-block mb-3">Daftar keunggulan produk (tampil sebagai list dengan centang).</small>

            <div id="keunggulan-wrapper">
                @php $keunggulanItems = old('keunggulan_item') ?? ($produk->keunggulan_list ?? []); @endphp
                @forelse($keunggulanItems as $item)
                <div class="row mb-2 keunggulan-row">
                    <div class="col-md-11">
                        <input type="text" name="keunggulan_item[]" class="form-control" value="{{ $item }}" placeholder="Contoh: Akurasi tinggi ±0.5%">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @empty
                <div class="row mb-2 keunggulan-row">
                    <div class="col-md-11"><input type="text" name="keunggulan_item[]" class="form-control" placeholder="Contoh: Akurasi tinggi ±0.5%"></div>
                    <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
                </div>
                @endforelse
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-keunggulan">+ Tambah Poin</button>

            <hr>

            {{-- ── APLIKASI PENGGUNAAN ── --}}
            <h5 class="mb-1 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Aplikasi Penggunaan</h5>
            <small class="text-muted d-block mb-3">Grid ikon industri/aplikasi (contoh: Industri Air, Kimia, Makanan).</small>

            <div id="aplikasi-wrapper">
                @php
        $appLabels    = old('app_label')          ?? array_column($produk->aplikasi_list ?? [], 'label');
        $appExisting  = array_column($produk->aplikasi_list ?? [], 'image_path');
    @endphp
    @if(count($appLabels))
        @foreach($appLabels as $i => $label)
        <div class="row mb-2 aplikasi-row">
            <div class="col-md-5">
                <input type="text" name="app_label[]" class="form-control" value="{{ $label }}" placeholder="Label aplikasi">
            </div>
            <div class="col-md-6">
                <input type="hidden" name="app_image_existing[]" value="{{ $appExisting[$i] ?? '' }}">
                <input type="file" name="app_image[]" class="form-control" accept="image/*">
                @if(!empty($appExisting[$i]))
                    <small class="text-muted">Foto saat ini: {{ $appExisting[$i] }}. Upload baru untuk mengganti.</small>
                @endif
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
            </div>
        </div>
            @endforeach
             @else
            <div class="row mb-2 aplikasi-row">
            <div class="col-md-5"><input type="text" name="app_label[]" class="form-control" placeholder="Label aplikasi"></div>
            <div class="col-md-6">
                <input type="hidden" name="app_image_existing[]" value="">
                <input type="file" name="app_image[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        <   /div>
            @endif
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-aplikasi">+ Tambah Aplikasi</button>

            <hr>

            {{-- ── GALLERY BADGES ── --}}
            <h5 class="mb-1 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Badge Foto Produk</h5>
            <small class="text-muted d-block mb-3">Badge kecil di bawah foto utama (contoh: Akurasi Tinggi, Tahan & Handal).</small>

            <div id="badges-wrapper">
                
                @php
        $gbLabels = old('gb_label') ?? array_column($produk->gallery_badges ?? [], 'label');
            @endphp
            @if(count($gbLabels))
                @foreach($gbLabels as $label)
                <div class="row mb-2 badge-row">
                    <div class="col-md-11"><input type="text" name="gb_label[]" class="form-control" value="{{ $label }}" placeholder="Label badge"></div>
                    <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
                </div>
                @endforeach
            @else
                <div class="row mb-2 badge-row">
                    <div class="col-md-11"><input type="text" name="gb_label[]" class="form-control" placeholder="Label badge"></div>
                    <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
                </div>
            @endif
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-badge">+ Tambah Badge</button>

            <hr>

            {{-- ── SPESIFIKASI TEKNIS ── --}}
            <h5 class="mb-1 text-muted text-uppercase" style="font-size:11px;letter-spacing:1px;">Spesifikasi Teknis</h5>
            <small class="text-muted d-block mb-3">Baris tabel spesifikasi (contoh: Akurasi | ±0.5%).</small>

            <div id="spesifikasi-wrapper">
                @php
                    $spekKeys   = old('spek_key')   ?? array_column($produk->getAllSpesifikasi(), 'key');
                    $spekValues = old('spek_value') ?? array_column($produk->getAllSpesifikasi(), 'value');
                @endphp
                @if(count($spekKeys))
                    @foreach($spekKeys as $i => $key)
                    <div class="row mb-2 spek-row">
                        <div class="col-md-5"><input type="text" name="spek_key[]" class="form-control" value="{{ $key }}" placeholder="Parameter (contoh: Akurasi)"></div>
                        <div class="col-md-6"><input type="text" name="spek_value[]" class="form-control" value="{{ $spekValues[$i] ?? '' }}" placeholder="Nilai (contoh: ±0.5%)"></div>
                        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
                    </div>
                    @endforeach
                @else
                    <div class="row mb-2 spek-row">
                        <div class="col-md-5"><input type="text" name="spek_key[]" class="form-control" placeholder="Parameter (contoh: Akurasi)"></div>
                        <div class="col-md-6"><input type="text" name="spek_value[]" class="form-control" placeholder="Nilai (contoh: ±0.5%)"></div>
                        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-spek">+ Tambah Baris</button>

        </div>{{-- card-body --}}

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Produk</button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-remove-row')) {
        const row = e.target.closest('.highlight-tag-row, .keunggulan-row, .aplikasi-row, .badge-row, .spek-row');
        if (row) row.remove();
    }
});

function addRow(wrapperId, templateHtml) {
    document.getElementById(wrapperId).insertAdjacentHTML('beforeend', templateHtml);
}

function toSlug(str) {
    return str
        .toLowerCase().trim()
        .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
        .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
        .replace(/[ùúûü]/g, 'u').replace(/[ñ]/g, 'n')
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
}

const namaInput = document.querySelector('[name="nama_produk"]');
const slugInput = document.getElementById('slug');
const slugPreview = document.getElementById('slug-preview');

slugInput.addEventListener('input', function() {
    slugPreview.textContent = this.value || '...';
});
document.getElementById('add-highlight-tag').addEventListener('click', function() {
    addRow('highlight-tags-wrapper', `
        <div class="row mb-2 highlight-tag-row">
            <div class="col-md-11"><input type="text" name="ht_label[]" class="form-control" placeholder="Label tag"></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        </div>`);
});

document.getElementById('add-keunggulan').addEventListener('click', function() {
    addRow('keunggulan-wrapper', `
        <div class="row mb-2 keunggulan-row">
            <div class="col-md-11"><input type="text" name="keunggulan_item[]" class="form-control" placeholder="Contoh: Akurasi tinggi ±0.5%"></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        </div>`);
});

document.getElementById('add-aplikasi').addEventListener('click', function() {
    addRow('aplikasi-wrapper', `
        <div class="row mb-2 aplikasi-row">
            <div class="col-md-5"><input type="text" name="app_label[]" class="form-control" placeholder="Label aplikasi"></div>
            <div class="col-md-6">
                <input type="hidden" name="app_image_existing[]" value="">
                <input type="file" name="app_image[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        </div>`);
});

document.getElementById('add-badge').addEventListener('click', function() {
    addRow('badges-wrapper', `
        <div class="row mb-2 badge-row">
            <div class="col-md-11"><input type="text" name="gb_label[]" class="form-control" placeholder="Label badge"></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        </div>`);
});

document.getElementById('add-spek').addEventListener('click', function() {
    addRow('spesifikasi-wrapper', `
        <div class="row mb-2 spek-row">
            <div class="col-md-5"><input type="text" name="spek_key[]" class="form-control" placeholder="Parameter (contoh: Akurasi)"></div>
            <div class="col-md-6"><input type="text" name="spek_value[]" class="form-control" placeholder="Nilai (contoh: ±0.5%)"></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
        </div>`);
});

document.getElementById('btn-generate-slug').addEventListener('click', function() {
    const generated = toSlug(namaInput.value);
    slugInput.value = generated;
    slugPreview.textContent = generated || '...';
});

</script>
@endpush
@endsection