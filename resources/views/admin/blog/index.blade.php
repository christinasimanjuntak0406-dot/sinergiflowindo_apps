@extends('admin.layout.app')

@section('title', 'Kelola Blog')

@section('content')

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
  </div>
@endif

<div class="mb-3">
  <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
    <i class="fas fa-plus mr-1"></i> Tambah Artikel
  </a>
</div>

<div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
      <tr>
        <th width="50">#</th>
        <th width="80">Gambar</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th width="100">Status</th>
        <th width="130">Tanggal</th>
        <th width="100">Views</th>
        <th width="110">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($blog as $item)
        <tr>
          <td>{{ $loop->iteration + ($blog->currentPage() - 1) * $blog->perPage() }}</td>
          <td>
            @if(!empty($item->gambar))
              <img src="{{ Storage::url($item->gambar) }}"
                   alt="{{ $item->judul }}"
                   class="img-thumbnail"
                   style="width:60px;height:50px;object-fit:cover;">
            @else
              <div class="text-center text-muted">
                <i class="fas fa-image fa-2x"></i>
              </div>
            @endif
          </td>
          <td>
            <strong>{{ $item->judul }}</strong><br>
            <small class="text-muted">{{ $item->slug }}</small>
          </td>
          <td>{{ $item->penulis ?? '-' }}</td>
          <td>
            @if($item->status === 'published')
              <span class="badge badge-success">Published</span>
            @else
              <span class="badge badge-secondary">Draft</span>
            @endif
          </td>
          <td>{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y') : '-' }}</td>
          <td>{{ number_format($item->views) }}</td>
          <td>
            <a href="{{ route('admin.blog.edit', $item->id) }}" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.blog.destroy', $item->id) }}" method="POST"
                  style="display:inline;" onsubmit="return confirm('Hapus artikel ini?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center text-muted py-4">
            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
            Belum ada artikel.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-3">
  {{ $blog->links() }}
</div>

@endsection