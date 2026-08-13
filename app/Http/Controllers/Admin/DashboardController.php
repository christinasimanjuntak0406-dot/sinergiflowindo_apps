<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Category;
use App\Models\Layanan;
use App\Models\Blog;
use App\Models\PesanKontak;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk   = Produk::count();
        $totalKategori = Category::count();
        $totalLayanan  = Layanan::count();
        $totalBlog     = Blog::count();
        $totalPesan    = PesanKontak::count();

        // Deteksi otomatis nama kolom status "sudah dibaca" di tabel pesan_kontaks.
        // Sesuaikan urutan/nama kolom di bawah kalau ternyata namanya berbeda.
        $pesanTable = (new PesanKontak())->getTable();

        if (Schema::hasColumn($pesanTable, 'dibaca')) {
            $pesanBelumDibaca = PesanKontak::where('dibaca', false)->count();
        } elseif (Schema::hasColumn($pesanTable, 'is_read')) {
            $pesanBelumDibaca = PesanKontak::where('is_read', false)->count();
        } elseif (Schema::hasColumn($pesanTable, 'status')) {
            $pesanBelumDibaca = PesanKontak::where('status', 'unread')->count();
        } else {
            // Fallback: kalau tidak ada kolom status, tampilkan total pesan saja
            $pesanBelumDibaca = $totalPesan;
        }

        $pesanTerbaru  = PesanKontak::latest()->take(5)->get();
        $produkTerbaru = Produk::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalKategori',
            'totalLayanan',
            'totalBlog',
            'totalPesan',
            'pesanBelumDibaca',
            'pesanTerbaru',
        ));
    }
}