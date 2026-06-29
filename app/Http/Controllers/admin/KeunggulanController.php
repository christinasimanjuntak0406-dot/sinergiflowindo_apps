<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    public function index()
    {
        $keunggulan = Keunggulan::all();
        return view('admin.keunggulan.index', compact('keunggulan'));
    }

    public function create()
    {
        return view('admin.keunggulan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'ikon'     => 'nullable|string|max:100',
        ]);

        Keunggulan::create($request->only('judul', 'deskripsi', 'ikon'));

        return redirect()->route('admin.keunggulan.index')
            ->with('success', 'Keunggulan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);
        return view('admin.keunggulan.edit', compact('keunggulan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'ikon'      => 'nullable|string|max:100',
        ]);

        Keunggulan::findOrFail($id)->update($request->only('judul', 'deskripsi', 'ikon'));

        return redirect()->route('admin.keunggulan.index')
            ->with('success', 'Keunggulan berhasil diupdate!');
    }

    public function destroy($id)
    {
        Keunggulan::findOrFail($id)->delete();

        return redirect()->route('admin.keunggulan.index')
            ->with('success', 'Keunggulan berhasil dihapus!');
    }
}