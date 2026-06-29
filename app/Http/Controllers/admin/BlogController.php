<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

    class BlogController extends Controller
    {
        public function index()
        { 
             $blog = Blog::with('category')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            $categories = Category::where('type', 'blog')->get();
            return view('admin.blog.index', compact('blog','categories'));
        }

        public function create()
        {
            $categories = Category::where('type', 'blog')->get();
            return view('admin.blog.create', compact ('categories'));
        }

        public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'konten'         => 'required',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penulis'        => 'nullable|string|max:100',
            'status'         => 'required|in:draft,published',
            'published_at'   => 'nullable|date',
            'sub_judul.*'    => 'nullable|string|max:255',
            'sub_konten.*'   => 'nullable|string',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis', 'kategori_id', 'status', 'published_at']);
        $data['slug'] = Str::slug($request->judul);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('blog', 'public');
        }

        // Auto set published_at jika status published dan belum diisi
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $blog = Blog::create($data);

        // Simpan sub judul
        if ($request->filled('sub_judul')) {
            foreach ($request->sub_judul as $i => $subJudul) {
                if (!empty($subJudul)) {
                    $blog->subJudul()->create([
                        'sub_judul'  => $subJudul,
                        'sub_konten' => $request->sub_konten[$i] ?? null,
                        'urutan'     => $i + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

        public function edit(Blog $blog)
        {
            
            $categories = Category::where('type', 'blog')->get();
            return view('admin.blog.edit', compact('blog','categories'));
        }

        public function update(Request $request, Blog $blog)
{
    $request->validate([
        'judul'          => 'required|string|max:255',
        'konten'         => 'required',
        'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'penulis'        => 'nullable|string|max:100',
        'status'         => 'required|in:draft,published',
        'published_at'   => 'nullable|date',
        'sub_judul.*'    => 'nullable|string|max:255',
        'sub_konten.*'   => 'nullable|string',
    ]);

    $data = $request->only(['judul', 'konten', 'penulis', 'kategori_id', 'status', 'published_at']);
    $data['slug'] = Str::slug($request->judul);

    // Upload gambar baru, hapus yang lama
    if ($request->hasFile('gambar')) {
        if ($blog->gambar) {
            Storage::disk('public')->delete($blog->gambar);
        }
        $data['gambar'] = $request->file('gambar')->store('blog', 'public');
    }

    // Auto set published_at
    if ($data['status'] === 'published' && empty($data['published_at'])) {
        $data['published_at'] = $blog->published_at ?? now();
    }

    $blog->update($data);

    // Hapus sub judul lama lalu simpan yang baru
    $blog->subJudul()->delete();

    if ($request->filled('sub_judul')) {
        foreach ($request->sub_judul as $i => $subJudul) {
            if (!empty($subJudul)) {
                $blog->subJudul()->create([
                    'sub_judul'  => $subJudul,
                    'sub_konten' => $request->sub_konten[$i] ?? null,
                    'urutan'     => $i + 1,
                ]);
            }
        }
    }
    return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui.');
}
       
        public function destroy(Blog $blog)
        {
            if ($blog->gambar) {
                Storage::disk('public')->delete($blog->gambar);
            }

            $blog->delete();

            return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus.');
        }
    }