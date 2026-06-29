@extends('admin.layout.app')
@section('title', 'Tambah Produk')
@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">Form Tambah Produk</h3>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-sm btn-secondary">← Kembali</a>
    </div>
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            {{-- ════════════════════════════════
                 1. INFORMASI DASAR
            ════════════════════════════════ --}}
            <h5 class="section-label">① Informasi Dasar</h5>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" id="nama_produk"
                            class="form-control @error('nama_produk') is-invalid @enderror"
                            value="{{ old('nama_produk') }}" required>
                        @error('nama_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>
                    Slug <span class="text-danger">*</span>
                    <small class="text-muted ml-1">(URL produk: /produk/<strong id="slug-preview">...</strong>)</small>
                </label>
                <div class="input-group">
                    <input type="text" name="slug" id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug') }}"
                        placeholder="flow-meter-lc-m-10" required>
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Model Number <small class="text-muted">(contoh: LC M-10)</small></label>
                        <input type="text" name="model_number" class="form-control"
                            value="{{ old('model_number') }}" placeholder="LC M-10">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Model Subtitle <small class="text-muted">(contoh: Positive Displacement Flow Meter)</small></label>
                        <input type="text" name="model_subtitle" class="form-control"
                            value="{{ old('model_subtitle') }}" placeholder="Positive Displacement Flow Meter">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat <small class="text-muted">(tampil di hero & card listing)</small></label>
                {{-- DB: deskripsi_singkat --}}
                <textarea name="deskripsi_singkat" class="form-control" rows="2"
                    placeholder="Pengukuran aliran akurat untuk berbagai aplikasi industri...">{{ old('deskripsi_singkat') }}</textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi Lengkap</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status_aktif" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <hr>

            {{-- ════════════════════════════════
                 2. GALLERY FOTO
                 DB: gambar, gambar2, gambar3, gambar4
            ════════════════════════════════ --}}
            <h5 class="section-label">② Gallery Foto</h5>

            <div class="row">
                @foreach(['gambar' => 'Foto Utama *', 'gambar2' => 'Foto 2', 'gambar3' => 'Foto 3', 'gambar4' => 'Foto 4'] as $field => $label)
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ $label }}</label>
                        <input type="file" name="{{ $field }}" class="form-control" accept="image/*"
                            onchange="previewImg(this, 'prev_{{ $field }}')">
                        <img id="prev_{{ $field }}" src="#" alt=""
                            style="display:none;width:100%;height:90px;object-fit:cover;border-radius:6px;margin-top:5px;">
                    </div>
                </div>
                @endforeach
            </div>

            <hr>

            {{-- ════════════════════════════════
                 3. DATASHEET
                 DB: datasheet_file
            ════════════════════════════════ --}}
            <h5 class="section-label">③ Datasheet</h5>

            <div class="form-group">
                <label>File Datasheet (PDF)</label>
                <input type="file" name="datasheet_file" class="form-control" accept=".pdf">
                <small class="text-muted">Maks. 10 MB. Tombol "Unduh Katalog" hanya muncul jika file ini diisi.</small>
            </div>

            <hr>
            <h5 class="section-label">④ Stats Bar</h5>
            <small class="text-muted d-block mb-3">
                4 kotak dark navy di bawah hero — contoh: <strong>Nominal Flow Rate | 150 GPM | (568 LPM)</strong>
            </small>

            <div id="highlight-specs-wrapper">
                @php
                $defaultSpecs = [
                    ['icon'=>'ti-droplet', 'label'=>'Nominal Flow Rate',      'value'=>'150 GPM',       'satuan'=>'(568 LPM)'],
                    ['icon'=>'ti-gauge',   'label'=>'Max Working Pressure',    'value'=>'150 psi',       'satuan'=>'(10.3 bar, 1034 kPa)'],
                    ['icon'=>'ti-box',     'label'=>'Construction Material',   'value'=>'Aluminum body', 'satuan'=>''],
                    ['icon'=>'ti-target',  'label'=>'Accuracy',                'value'=>'±0.02%',        'satuan'=>'Repeatability'],
                ];
                @endphp
                @foreach($defaultSpecs as $spec)
                <div class="row mb-2 spec-highlight-row">
                    <div class="col-md-2">
                        <input type="text" name="hs_icon[]" class="form-control" placeholder="Icon" value="{{ $spec['icon'] }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="hs_label[]" class="form-control" placeholder="Label" value="{{ $spec['label'] }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="hs_value[]" class="form-control" placeholder="Nilai" value="{{ $spec['value'] }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="hs_satuan[]" class="form-control" placeholder="Satuan/sub" value="{{ $spec['satuan'] }}">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-highlight-spec">+ Tambah Stats</button>

            <hr>

            {{-- ════════════════════════════════
                 5. HIGHLIGHT TAGS
                 DB: highlight_tags (JSON)
                 Format: [{icon, label}]
            ════════════════════════════════ --}}
            <h5 class="section-label">⑤ Highlight Tags</h5>
            <small class="text-muted d-block mb-3">Badge kecil di bawah nama produk (contoh: Akurasi Tinggi, Tahan & Andal).</small>

            <div id="highlight-tags-wrapper">
                @for($i = 0; $i < 4; $i++)
                <div class="row mb-2 highlight-tag-row">
                <div class="col-md-11">
                <input type="text" name="ht_label[]" class="form-control" placeholder="Label (contoh: Akurasi Tinggi)">
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                </div>
                </div>
                @endfor
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-highlight-tag">+ Tambah Tag</button>
            <hr>
            <h5 class="section-label">⑥ Poin Keunggulan</h5>
            <small class="text-muted d-block mb-3">Daftar keunggulan produk (tampil sebagai checklist di frontend).</small>

            <div id="keunggulan-wrapper">
                @for($i = 0; $i < 6; $i++)
                <div class="row mb-2 keunggulan-row">
                    <div class="col-md-11">
                        <input type="text" name="keunggulan_item[]" class="form-control"
                            placeholder="Contoh: Akurasi tinggi ±0.5%">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endfor
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-keunggulan">+ Tambah Poin</button>
            <hr>

            <h5 class="section-label">⑦ Spesifikasi Teknis</h5>
            <small class="text-muted d-block mb-3">Tabel spesifikasi (Parameter | Nilai) — tampil di halaman detail produk.</small>
            <div id="spesifikasi-wrapper">
                @for($i = 0; $i < 8; $i++)
                <div class="row mb-2 spek-row">
                    <div class="col-md-5">
                        <input type="text" name="spek_key[]" class="form-control"
                            placeholder="Parameter (contoh: Nominal Flow Rate)">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="spek_value[]" class="form-control"
                            placeholder="Nilai (contoh: 150 GPM / 568 LPM)">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endfor
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-spek">+ Tambah Baris</button>
            <hr>
            <h5 class="section-label">⑨ Aplikasi Penggunaan</h5>
            <small class="text-muted d-block mb-3">Grid industri dengan foto background + icon + label.</small>

            <div id="aplikasi-wrapper">
                @php
                $defaultApps = [
                    'SPBU & Fuel Management',
                    'Water Treatment',
                    'Chemical Plant',
                    'Oil & Gas Industry',
                    'Food & Beverage Industry',
                    'Manufacturing Industry',
                ];
                @endphp
                @foreach($defaultApps as $app)
                <div class="row mb-2 aplikasi-row">
                    <div class="col-md-5">
                        <input type="text" name="app_label[]" class="form-control" value="{{ $app }}" placeholder="Label">
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="app_image[]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-aplikasi">+ Tambah Aplikasi</button>
            <hr>

            {{-- ════════════════════════════════
                 10. GALLERY BADGES
                 DB: gallery_badges (JSON)
                 Format: [{icon, label}]
            ════════════════════════════════ --}}
            <h5 class="section-label">⑩ Badge Foto Produk</h5>
            <small class="text-muted d-block mb-3">Badge kecil di bawah foto utama (contoh: Akurasi Tinggi, Tahan & Andal).</small>

            <div id="badges-wrapper">
                @for($i = 0; $i < 4; $i++)
                <div class="row mb-2 badge-row">
                    <div class="col-md-11">
                        <input type="text" name="gb_label[]" class="form-control" placeholder="Label badge">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endfor
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-badge">+ Tambah Badge</button>

            <hr>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Simpan Produk
            </button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </div>
    </form>
</div>

<style>
.section-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 10px;
    margin-top: 4px;
}
</style>

@push('scripts')
<script>
// ── Auto-generate slug dari nama produk
function toSlug(str) {
    return str
        .toLowerCase()
        .trim()
        .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
        .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
        .replace(/[ùúûü]/g, 'u').replace(/[ñ]/g, 'n')
        .replace(/[^a-z0-9\s-]/g, '')   // hapus karakter selain huruf/angka/spasi/strip
        .replace(/\s+/g, '-')            // spasi → strip
        .replace(/-+/g, '-')             // strip berulang → satu strip
        .replace(/^-|-$/g, '');          // hapus strip di awal/akhir
}

const namaInput = document.getElementById('nama_produk');
const slugInput = document.getElementById('slug');
const slugPreview = document.getElementById('slug-preview');
let slugManuallyEdited = false;

// Update preview realtime
slugInput.addEventListener('input', function() {
    slugManuallyEdited = true;
    slugPreview.textContent = this.value || '...';
});

// Auto-generate saat ketik nama (hanya jika slug belum diedit manual)
namaInput.addEventListener('input', function() {
    if (!slugManuallyEdited) {
        const generated = toSlug(this.value);
        slugInput.value = generated;
        slugPreview.textContent = generated || '...';
    }
});

// Tombol generate paksa
document.getElementById('btn-generate-slug').addEventListener('click', function() {
    const generated = toSlug(namaInput.value);
    slugInput.value = generated;
    slugPreview.textContent = generated || '...';
    slugManuallyEdited = false;
});

// ── Preview gambar sebelum upload
function previewImg(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Hapus baris dinamis
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-remove-row');
    if (btn) {
        const row = btn.closest('.spec-highlight-row, .highlight-tag-row, .keunggulan-row, .aplikasi-row, .badge-row, .spek-row');
        if (row) row.remove();
    }
});

// Helper
function addRow(wrapperId, html) {
    document.getElementById(wrapperId).insertAdjacentHTML('beforeend', html);
}

document.getElementById('add-highlight-spec').addEventListener('click', () => addRow('highlight-specs-wrapper', `
    <div class="row mb-2 spec-highlight-row">
        <div class="col-md-2"><input type="text" name="hs_icon[]" class="form-control" placeholder="Icon"></div>
        <div class="col-md-3"><input type="text" name="hs_label[]" class="form-control" placeholder="Label"></div>
        <div class="col-md-3"><input type="text" name="hs_value[]" class="form-control" placeholder="Nilai"></div>
        <div class="col-md-3"><input type="text" name="hs_satuan[]" class="form-control" placeholder="Satuan/sub"></div>
        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
    </div>`));

document.getElementById('add-highlight-tag').addEventListener('click', () => addRow('highlight-tags-wrapper', `
    <div class="row mb-2 highlight-tag-row">
        <div class="col-md-11"><input type="text" name="ht_label[]" class="form-control" placeholder="Label"></div>
        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
    </div>`));

document.getElementById('add-keunggulan').addEventListener('click', () => addRow('keunggulan-wrapper', `
    <div class="row mb-2 keunggulan-row">
        <div class="col-md-11"><input type="text" name="keunggulan_item[]" class="form-control" placeholder="Poin keunggulan"></div>
        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
    </div>`));

document.getElementById('add-spek').addEventListener('click', () => addRow('spesifikasi-wrapper', `
    <div class="row mb-2 spek-row">
        <div class="col-md-5"><input type="text" name="spek_key[]" class="form-control" placeholder="Parameter"></div>
        <div class="col-md-6"><input type="text" name="spek_value[]" class="form-control" placeholder="Nilai"></div>
        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
    </div>`));

document.getElementById('add-aplikasi').addEventListener('click', () => addRow('aplikasi-wrapper', `
    <div class="row mb-2 aplikasi-row">
        <div class="col-md-5"><input type="text" name="app_label[]" class="form-control" placeholder="Label"></div>
        <div class="col-md-6"><input type="file" name="app_image[]" class="form-control" accept="image/*"></div>
        <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
    </div>`));


document.getElemsentById('add-badge').addEventListener('click', () => addRow('badges-wrapper', `
    <div class="row mb-2 badge-row">
        <div class="col-md-11"><input type="text" name="gb_label[]" class="form-control" placeholder="Label"></div>
        <div class="col-md-1 d-flex align-iStems-center"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fas fa-times"></i></button></div>
    </div>`));

</script>
@endpush
@endsection