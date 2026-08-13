<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = false;
    protected $table = 'produk';
    
    protected $fillable = [
        'nama_produk',
        'slug',
        'deskripsi',
        'deskripsi_singkat',
        'spesifikasi',
        'spesifikasi_json',
        'gambar',
        'gambar2',
        'gambar3',
        'gambar4',
        'status_aktif',
        'category_id',
        'datasheet_file',

        // Kolom baru
        'model_number',
        'model_subtitle',
        'dim_width',
        'dim_height',
        'dim_depth',
        'gambar_dimensi',
        'highlight_specs',   // tambah
        'highlight_tags',
        'keunggulan_list',
        'aplikasi_list',
        'gallery_badges',
    ];

    protected $casts = [
        'highlight_tags'   => 'array',
        'highlight_specs'  => 'array',  // tambah
        'keunggulan_list'  => 'array',
        'spesifikasi_json' => 'array',
        'aplikasi_list'    => 'array',
        'gallery_badges'   => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProdukImage::class);
    }

    public function getAllGambar(): array
    {
        return array_values(array_filter([
            $this->gambar,
            $this->gambar2,
            $this->gambar3,
            $this->gambar4,
        ]));
    }

    public function getAllSpesifikasi(): array
    {
        if (!empty($this->spesifikasi_json)) {
            return $this->spesifikasi_json;
        }
        $lines = array_filter(array_map('trim', explode("\n", $this->spesifikasi ?? '')));
        $parsed = [];
        foreach ($lines as $line) {
            if (str_contains($line, ':')) {
                [$k, $v] = explode(':', $line, 2);
                $parsed[] = ['key' => trim($k), 'value' => trim($v)];
            }
        }
        return $parsed;
    }
}