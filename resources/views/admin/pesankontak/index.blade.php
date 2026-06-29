@extends('admin.layout.app')

@section('title', 'Pesan-Kontak')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-semibold">Pesan Kontak</h4>
            <p class="text-muted mb-0">
                Total belum dibaca:
                <span class="badge bg-warning text-dark">{{ $jumlahBelumDibaca }}</span>
            </p>
        </div>
        <div class="col-md-6 text-end">
            <form method="GET" action="{{ route('admin.pesan-kontak.index') }}">
                <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="belum dibaca" {{ request('status') == 'belum dibaca' ? 'selected' : '' }}>
                        Belum Dibaca
                    </option>
                    <option value="sudah dibaca" {{ request('status') == 'sudah dibaca' ? 'selected' : '' }}>
                        Sudah Dibaca
                    </option>
                </select>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pengirim</th>
                            <th>Email</th>
                            <th>No.Telp</th>
                            <th>Subjek</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanKontak as $pesan)
                        <tr class="{{ $pesan->status === 'belum dibaca' ? 'fw-semibold' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pesan->nama_pengirim }}</td>
                            <td>{{ $pesan->email_pengirim ?? '-' }}</td>
                            <td>{{ $pesan->subjek ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesan->created_at)->format('d M Y, H:i') }}</td>
                            <td>
                                @if($pesan->status === 'belum dibaca')
                                    <span class="badge bg-warning text-dark">Belum Dibaca</span>
                                @else
                                    <span class="badge bg-success">Sudah Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pesan-kontak.show', $pesan->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>

                                <form action="{{ route('admin.pesan-kontak.destroy', $pesan->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $pesanKontak->withQueryString()->links() }}
    </div>
</div>
@endsection