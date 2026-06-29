@extends('admin.layout.app')
@section('title', 'Kelola Layanan')

@section('content')

{{-- Alert --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

{{-- CARD UTAMA --}}
<div class="card border-0 shadow-sm">

    {{-- HEADER --}}
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center"
         style="border-left: 4px solid #007bff;">
        <h5 class="mb-0 font-weight-bold text-primary">
            <i class="fas fa-concierge-bell mr-2"></i>Daftar Layanan
        </h5>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary btn-sm px-3">
            <i class="fas fa-plus mr-1"></i>Tambah Layanan
        </a>
    </div>

    {{-- BODY --}}
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="50">#</th>
                    <th width="80">Ikon</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th width="100">Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanan as $item)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle text-center">
                        <i class="fas {{ $item->ikon ?? 'fa-concierge-bell' }} fa-lg text-primary"></i>
                    </td>
                    <td class="align-middle font-weight-bold">{{ $item->nama_layanan }}</td>
                    <td class="align-middle text-muted" style="font-size:0.88rem;">
                        {{ Str::limit($item->deskripsi, 80, '...') }}
                    </td>
                    <td class="align-middle">
                        @if($item->status_aktif)
                            <span class="badge badge-success px-2 py-1">Aktif</span>
                        @else
                            <span class="badge badge-danger px-2 py-1">Nonaktif</span>
                        @endif
                    </td>
                    <td class="align-middle">
                        <a href="{{ route('admin.layanan.edit', $item->id) }}"
                           class="btn btn-warning btn-sm mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.layanan.destroy', $item->id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus layanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-concierge-bell fa-3x mb-3 d-block"></i>
                        Belum ada layanan. Klik <strong>Tambah Layanan</strong> untuk memulai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection