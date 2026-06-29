@extends('admin.layout.app')

@section('title', 'Tambah Artikel Blog')

@section('content')

<div class="mb-3">
  <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left mr-1"></i> Kembali
  </a>
</div>

@if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
  </div>
@endif

<form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row">

    {{-- Kolom Kiri --}}
    <div class="col-md-8">

      <div class="form-group">
        <label>Judul Artikel <span class="text-danger">*</span></label>
        <input type="text" name="judul"
               class="form-control @error('judul') is-invalid @enderror"
               value="{{ old('judul') }}"
               placeholder="Masukkan judul artikel...">
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label>Konten <span class="text-danger">*</span></label>
        <textarea name="konten" id="konten"
                  class="@error('konten') is-invalid @enderror"
                  style="display:none;">{{ old('konten') }}</textarea>
        @error('konten') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        <div id="quill-editor" style="height:400px; background:#fff;"></div>
      </div>

      {{-- Sub Judul Dinamis --}}
      <div class="form-group">
        <label>Sub Judul & Konten Tambahan</label>

        <div id="sub-judul-container">
          <div class="sub-judul-item border rounded p-3 mb-2">
            <div class="form-group mb-2">
              <input type="text" name="sub_judul[]"
                     class="form-control"
                     placeholder="Sub Judul...">
            </div>
            <div class="form-group mb-0">
              <textarea name="sub_konten[]" class="form-control" rows="3"
                        placeholder="Konten untuk sub judul ini..."></textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2 hapus-sub">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </div>

        <button type="button" id="tambah-sub" class="btn btn-secondary btn-sm mt-1">
          <i class="fas fa-plus"></i> Tambah Sub Judul
        </button>
      </div>

    </div>

    {{-- Kolom Kanan --}}
    <div class="col-md-4">

      {{-- Gambar --}}
      <div class="form-group">
        <label>Gambar Cover</label>
        <div class="mb-2">
          <img id="preview-gambar" src="" alt="Preview"
               class="img-thumbnail w-100"
               style="height:180px;object-fit:cover;display:none;">
          <div id="placeholder-gambar"
               class="border rounded d-flex align-items-center justify-content-center bg-light"
               style="height:180px;">
            <div class="text-center text-muted">
              <i class="fas fa-image fa-3x mb-2"></i>
              <p class="mb-0 small">Preview Gambar</p>
            </div>
          </div>
        </div>
        <input type="file" name="gambar" id="gambar"
               class="form-control-file @error('gambar') is-invalid @enderror"
               accept="image/*" onchange="previewGambar(this)">
        <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</small>
        @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
      </div>

      {{-- Kategori --}}
      <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
          <option value="">-- Pilih Kategori --</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      {{-- Penulis --}}
      <div class="form-group">
        <label>Penulis</label>
        <input type="text" name="penulis"
               class="form-control @error('penulis') is-invalid @enderror"
               value="{{ old('penulis', Auth::user()->name) }}"
               placeholder="Nama penulis...">
        @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      {{-- Status --}}
      <div class="form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror">
          <option value="draft"     {{ old('status') == 'draft'     ? 'selected' : '' }}>Draft</option>
          <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      {{-- Tanggal Publish --}}
      <div class="form-group">
        <label>Tanggal Publish</label>
        <input type="datetime-local" name="published_at"
               class="form-control @error('published_at') is-invalid @enderror"
               value="{{ old('published_at') }}">
        <small class="text-muted">Kosongkan untuk otomatis saat disimpan.</small>
        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">
          <i class="fas fa-save mr-1"></i> Simpan Artikel
        </button>
      </div>

    </div>
  </div>

</form>

@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
  // Inisialisasi Quill
  var quill = new Quill('#quill-editor', {
    theme: 'snow',
    modules: {
      toolbar: [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        ['link', 'image'],
        ['clean']
      ]
    },
    placeholder: 'Tulis isi artikel di sini...'
  });

  var existing = document.getElementById('konten').value;
  if (existing) {
    quill.root.innerHTML = existing;
  }

  document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('konten').value = quill.root.innerHTML;
  });

  // Preview gambar
  function previewGambar(input) {
    const preview = document.getElementById('preview-gambar');
    const placeholder = document.getElementById('placeholder-gambar');
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Tambah sub judul
  document.getElementById('tambah-sub').addEventListener('click', function () {
    const container = document.getElementById('sub-judul-container');
    const item = document.createElement('div');
    item.className = 'sub-judul-item border rounded p-3 mb-2';
    item.innerHTML = `
      <div class="form-group mb-2">
        <input type="text" name="sub_judul[]" class="form-control" placeholder="Sub Judul...">
      </div>
      <div class="form-group mb-0">
        <textarea name="sub_konten[]" class="form-control" rows="3"
                  placeholder="Konten untuk sub judul ini..."></textarea>
      </div>
      <button type="button" class="btn btn-danger btn-sm mt-2 hapus-sub">
        <i class="fas fa-trash"></i> Hapus
      </button>
    `;
    container.appendChild(item);
    bindHapus();
  });

  // Hapus sub judul
  function bindHapus() {
    document.querySelectorAll('.hapus-sub').forEach(function (btn) {
      btn.onclick = function () {
        const items = document.querySelectorAll('.sub-judul-item');
        if (items.length > 1) {
          btn.closest('.sub-judul-item').remove();
        } else {
          alert('Minimal harus ada 1 sub judul.');
        }
      };
    });
  }
  bindHapus();
</script>
@endpush