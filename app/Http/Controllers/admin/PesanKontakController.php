<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;
class PesanKontakController extends Controller
{
    public function index(Request $request)
    {
        $query = PesanKontak::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pesanKontak = $query->paginate(10);
        $jumlahBelumDibaca = PesanKontak::where('status', 'belum dibaca')->count();

        return view('admin.pesankontak.index', compact('pesanKontak', 'jumlahBelumDibaca'));
    }

    public function show($id)
    {
        $pesan = PesanKontak::findOrFail($id);

        if ($pesan->status === 'belum dibaca') {
            $pesan->update(['status' => 'sudah dibaca']);
        }

        return view('admin.pesankontak.show', compact('pesan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengirim'  => 'required|string|max:100',
            'email_pengirim' => 'nullable|email|max:100',
            'subjek'         => 'nullable|string|max:200',
            'nomor_telepon'  => 'nullable|string|max:200',
            'isi_pesan'      => 'nullable|string',
        ]);
          
        $pesanKontak = PesanKontak::create($validated);
        Mail::to('christinasimanjuntak1709@gmail.com')
        ->send(new OrderNotification($pesanKontak));
        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }

    public function tandaiDibaca($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->update(['status' => 'sudah dibaca']);

        return redirect()->back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesankontak.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}