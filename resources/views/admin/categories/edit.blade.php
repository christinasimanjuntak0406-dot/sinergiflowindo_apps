@extends('admin.layout.app')
@section('title', 'Edit Kategori')
@section('content')
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
    <label>Tipe Kategori</label>
    <select name="type" class="form-control @error('type') is-invalid @enderror" required>
        <option value="">-- Pilih Tipe --</option>
        <option value="blog" {{ old('type', $category->type) == 'blog' ? 'selected' : '' }}>Blog</option>
        <option value="produk" {{ old('type', $category->type) == 'produk' ? 'selected' : '' }}>Produk</option>
    </select>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection