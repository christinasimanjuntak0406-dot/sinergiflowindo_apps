<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('type', 'produk')->orderBy('name')->get();

        $produk = Produk::with('category')
            ->when($request->q, fn($q, $v) =>
                $q->where('nama_produk', 'like', "%$v%")
                  ->orWhere('model_number', 'like', "%$v%")
                  ->orWhere('slug', 'like', "%$v%")
            )
            ->when($request->category_id, fn($q, $v) =>
                $q->where('category_id', $v)
            )
            ->when($request->status !== null && $request->status !== '', fn($q) =>
                $q->where('status_aktif', $request->status)
            )
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.produk.index', compact('produk', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'produk')->get();
        return view('admin.produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'    => 'required|string|max:150',
            'slug'           => 'required|string|max:200|unique:produk,slug',
            'category_id'    => 'nullable|exists:categories,id',
            'deskripsi'      => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar2'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar3'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar4'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'datasheet_file' => 'nullable|mimes:pdf|max:10240',
            'status_aktif'   => 'nullable|boolean',
        ]);

        $data = [
            'category_id'       => $request->category_id,
            'nama_produk'       => $request->nama_produk,
            'slug'              => $this->generateUniqueSlug($request->slug),
            'model_number'      => $request->model_number,
            'model_subtitle'    => $request->model_subtitle,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi'         => $request->deskripsi,
            'status_aktif'      => $request->status_aktif ?? 1,
            'highlight_specs'   => $this->buildHighlightSpecs($request),
            'highlight_tags'    => $this->buildHighlightTags($request),
            'keunggulan_list'   => $this->buildKeunggulanList($request),
            'spesifikasi_json'  => $this->buildSpesifikasiJson($request),
            'gallery_badges'    => $this->buildGalleryBadges($request),
        ];

        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $i => $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $this->uploadFile(
                    $request->file($field),
                    'uploads/produk',
                    time() . '_' . ($i + 1)
                );
            }
        }
        if ($request->hasFile('datasheet_file')) {
            $pdf     = $request->file('datasheet_file');
            $namaPdf = time() . '_' . Str::slug(pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $pdf->move(public_path('uploads/datasheet'), $namaPdf);
            $data['datasheet_file'] = $namaPdf;
        }

        $data['aplikasi_list'] = $this->buildAplikasiList($request);

        Produk::create($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $categories = Category::where('type', 'produk')->get();
        $produk     = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk'    => 'required|string|max:150',
            'slug'           => 'required|string|max:200|unique:produk,slug,' . $produk->id,
            'category_id'    => 'nullable|exists:categories,id',
            'deskripsi'      => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar2'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar3'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar4'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'datasheet_file' => 'nullable|mimes:pdf|max:10240',
            'status_aktif'   => 'nullable|boolean',
        ]);

        $data = [
            'category_id'       => $request->category_id,
            'nama_produk'       => $request->nama_produk,
            'slug'              => $request->slug,
            'model_number'      => $request->model_number,
            'model_subtitle'    => $request->model_subtitle,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi'         => $request->deskripsi,
            'status_aktif'      => $request->status_aktif ?? 1,
            'highlight_specs'   => $this->buildHighlightSpecs($request),
            'highlight_tags'    => $this->buildHighlightTags($request),
            'keunggulan_list'   => $this->buildKeunggulanList($request),
            'spesifikasi_json'  => $this->buildSpesifikasiJson($request),
            'gallery_badges'    => $this->buildGalleryBadges($request),
        ];

        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $i => $field) {
            if ($request->hasFile($field)) {
                $this->deleteFile('uploads/produk/' . $produk->$field);
                $data[$field] = $this->uploadFile(
                    $request->file($field),
                    'uploads/produk',
                    time() . '_' . ($i + 1)
                );
            }
        }
        if ($request->hasFile('datasheet_file')) {
            $this->deleteFile('uploads/datasheet/' . $produk->datasheet_file);
            $pdf     = $request->file('datasheet_file');
            $namaPdf = time() . '_' . Str::slug(pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $pdf->move(public_path('uploads/datasheet'), $namaPdf);
            $data['datasheet_file'] = $namaPdf;
        }

        $data['aplikasi_list'] = $this->buildAplikasiList($request, $produk);

        $produk->update($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $field) {
            $this->deleteFile('uploads/produk/' . $produk->$field);
        }
        $this->deleteFile('uploads/produk/dimensi/' . $produk->gambar_dimensi);
        $this->deleteFile('uploads/datasheet/' . $produk->datasheet_file);

        // Hapus foto aplikasi
        foreach ($produk->aplikasi_list ?? [] as $app) {
            if (!empty($app['image_path'])) {
                $this->deleteFile('uploads/produk/aplikasi/' . $app['image_path']);
            }
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    // ══════════════════════════════════════════════
    // HELPERS — Upload & File
    // ══════════════════════════════════════════════

    private function uploadFile($file, string $folder, string $prefix): string
    {
        $ext      = $file->getClientOriginalExtension();
        $namaFile = $prefix . '.' . $ext;
        $file->move(public_path($folder), $namaFile);
        return $namaFile;
    }

    private function deleteFile(string $path): void
    {
        $full = public_path($path);
        if ($path && file_exists($full)) {
            @unlink($full);
        }
    }

    // ══════════════════════════════════════════════
    // HELPERS — Slug
    // ══════════════════════════════════════════════

    private function generateUniqueSlug(string $slug): string
    {
        $slug     = Str::slug($slug);
        $original = $slug;
        $counter  = 1;

        while (Produk::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }

   

    // ══════════════════════════════════════════════
    // HELPERS — JSON Builders
    // ══════════════════════════════════════════════

    private function buildHighlightSpecs(Request $r): array
    {
        $icons   = $r->input('hs_icon', []);
        $labels  = $r->input('hs_label', []);
        $values  = $r->input('hs_value', []);
        $satuans = $r->input('hs_satuan', []);
        $result  = [];

        foreach ($labels as $i => $label) {
            if (!empty($label)) {
                $result[] = [
                    'icon'   => $icons[$i]   ?? '',
                    'label'  => trim($label),
                    'value'  => trim($values[$i]  ?? ''),
                    'satuan' => trim($satuans[$i] ?? ''),
                ];
            }
        }

        return $result;
    }

    private function buildHighlightTags(Request $r): array
    {
        $icons  = $r->input('ht_icon', []);
        $labels = $r->input('ht_label', []);
        $result = [];

        foreach ($labels as $i => $label) {
            if (!empty($label)) {
                $result[] = ['icon' => $icons[$i] ?? '', 'label' => trim($label)];
            }
        }

        return $result;
    }

    private function buildKeunggulanList(Request $r): array
    {
        $items = $r->input('keunggulan_item', []);
        return array_values(array_filter(array_map('trim', $items)));
    }

    private function buildSpesifikasiJson(Request $r): array
    {
        $keys   = $r->input('spek_key', []);
        $values = $r->input('spek_value', []);
        $result = [];

        foreach ($keys as $i => $key) {
            if (!empty($key)) {
                $result[] = ['key' => trim($key), 'value' => trim($values[$i] ?? '')];
            }
        }

        return $result;
    }

    /**
     * Aplikasi list — upload foto background per item.
     *
     * View mengirim:
     *   app_icon[]             — icon class
     *   app_label[]            — label teks
     *   app_image[]            — file upload baru (boleh kosong)
     *   app_image_existing[]   — nama file lama dari hidden input (khusus edit)
     *
     * Data disimpan dengan key 'image_path' agar konsisten dengan read di view/edit.
     */
    private function buildAplikasiList(Request $r, ?Produk $existing = null): array
    {
        $icons       = $r->input('app_icon', []);
        $labels      = $r->input('app_label', []);
        $existings   = $r->input('app_image_existing', []); // hidden input nilai lama
        $files       = $r->file('app_image', []);
        $result      = [];

        foreach ($labels as $i => $label) {
            if (empty($label)) continue;

            // Mulai dari path lama (kosong string untuk data baru)
            $imagePath = $existings[$i] ?? null;

            // Kalau ada file baru diunggah, replace
            if (!empty($files[$i])) {
                $imagePath = $this->uploadFile(
                    $files[$i],
                    'uploads/produk/aplikasi',
                    time() . '_app_' . $i
                );
            }

            $result[] = [
                'icon'       => $icons[$i] ?? '',
                'label'      => trim($label),
                'image_path' => $imagePath, // konsisten dengan key di view
            ];
        }

        return $result;
    }

    private function buildGalleryBadges(Request $r): array
    {
        $icons  = $r->input('gb_icon', []);
        $labels = $r->input('gb_label', []);
        $result = [];

        foreach ($labels as $i => $label) {
            if (!empty($label)) {
                $result[] = ['icon' => $icons[$i] ?? '', 'label' => trim($label)];
            }
        }

        return $result;
    }
}