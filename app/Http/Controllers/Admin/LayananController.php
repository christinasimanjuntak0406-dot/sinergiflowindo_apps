<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // Tampilkan semua layanan
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    // Form tambah layanan
    public function create()
    {
        return view('admin.layanan.create');
    }

    // Simpan layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'ikon'         => 'nullable|string|max:100',
            'status_aktif' => 'nullable|boolean',
        ]);

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'ikon'         => $request->ikon,
            'status_aktif' => $request->status_aktif ?? 1,
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    // Form edit layanan
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    // Update layanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'ikon'         => 'nullable|string|max:100',
            'status_aktif' => 'nullable|boolean',
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'ikon'         => $request->ikon,
            'status_aktif' => $request->status_aktif ?? 1,
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diupdate!');
    }

    // Hapus layanan
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}