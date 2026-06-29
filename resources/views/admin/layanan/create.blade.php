@extends('admin.layout.app')
@section('title', 'Tambah Layanan')

@section('content')

{{-- Validation Errors --}}
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle mr-2"></i>
    <ul class="mb-0 pl-3">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div class="card border-0 shadow-sm">

    {{-- HEADER --}}
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center"
         style="border-left: 4px solid #007bff;">
        <h5 class="mb-0 font-weight-bold text-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Layanan
        </h5>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary btn-sm px-3">
            <i class="fas fa-arrow-left mr-1"></i>Kembali
        </a>
    </div>

    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf
        <div class="card-body p-4">

            {{-- Nama Layanan --}}
            <div class="form-group">
                <label class="font-weight-bold">Nama Layanan <span class="text-danger">*</span></label>
                <input type="text" name="nama_layanan"
                       class="form-control @error('nama_layanan') is-invalid @enderror"
                       value="{{ old('nama_layanan') }}"
                       placeholder="Contoh: Pengiriman Cepat" required>
                @error('nama_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label class="font-weight-bold">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          rows="4"
                          placeholder="Jelaskan layanan ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ikon --}}
            <div class="form-group">
                <label class="font-weight-bold">
                    Ikon <small class="text-muted font-weight-normal">(FontAwesome class)</small>
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="previewIcon">
                            <i id="iconPreview" class="fas fa-concierge-bell"></i>
                        </span>
                    </div>
                    <input type="text" name="ikon" id="inputIkon"
                           class="form-control @error('ikon') is-invalid @enderror"
                           value="{{ old('ikon', 'fa-concierge-bell') }}"
                           placeholder="Contoh: fa-truck, fa-shield-alt, fa-award">
                    @error('ikon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small class="text-muted">
                    Cek icon di <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a>.
                    Cukup tulis nama iconnya saja, contoh: <code>fa-truck</code>
                </small>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label class="font-weight-bold">Status</label>
                <select name="status_aktif" class="form-control" style="max-width:200px;">
                    <option value="1" {{ old('status_aktif', '1') == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ old('status_aktif') == '0' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i>Simpan Layanan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary px-4 ml-2">
                <i class="fas fa-times mr-1"></i>Batal
            </a>
        </div>
    </form>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputIkon  = document.getElementById('inputIkon');
    const iconPreview = document.getElementById('iconPreview');

    function updatePreview() {
        const val = inputIkon.value.trim();
        // Hapus semua class fa- lama, pertahankan 'fas'
        iconPreview.className = 'fas ' + (val || 'fa-concierge-bell');
    }

    inputIkon.addEventListener('input', updatePreview);
    updatePreview(); // jalankan saat load
});
</script>
@endpush

@endsection