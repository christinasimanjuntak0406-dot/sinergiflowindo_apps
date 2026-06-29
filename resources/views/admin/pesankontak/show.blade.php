@extends('admin.layout.app')

@section('title', 'Detail Pesan Kontak')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('admin.pesan-kontak.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="max-width: 680px;">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Detail Pesan</h6>
            @if($pesan->status === 'belum dibaca')
                <span class="badge bg-warning text-dark">Belum Dibaca</span>
            @else
                <span class="badge bg-success">Sudah Dibaca</span>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <td class="text-muted" style="width: 160px;">Nama Pengirim</td>
                    <td class="fw-semibold">{{ $pesan->nama_pengirim }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Email</td>
                    <td>
                        @if($pesan->email_pengirim)
                            <a href="mailto:{{ $pesan->email_pengirim }}">{{ $pesan->email_pengirim }}</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Subjek</td>
                    <td>{{ $pesan->subjek ?? '-' }}</td>
                </tr>
                 <tr>
                    <td class="text-muted">No.Telp</td>
                    <td>{{ $pesan->No_Telp?? '-' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Waktu Masuk</td>
                    <td>{{ \Carbon\Carbon::parse($pesan->created_at)->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Isi Pesan</td>
                    <td></td>
                </tr>
            </table>

            <div class="bg-light rounded p-3 mt-1" style="white-space: pre-wrap; font-size: 15px;">
                {{ $pesan->isi_pesan ?? '-' }}
            </div>
        </div>
        <div class="card-footer bg-white border-top d-flex gap-2 pt-3">
            @if($pesan->status === 'belum dibaca')
                <form action="{{ route('admin.pesan-kontak.baca', $pesan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-outline-success">
                        <i class="bi bi-check2"></i> Tandai Sudah Dibaca
                    </button>
                </form>
            @endif

            <form action="{{ route('admin.pesan-kontak.destroy', $pesan->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection