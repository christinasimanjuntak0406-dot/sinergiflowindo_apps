<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis',
        'status',
        'views',
        'published_at',
        'kategori_id',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'kategori_id');
    }
    public function subJudul()
    {
    return $this->hasMany(BlogSubJudul::class, 'blog_id')->orderBy('urutan');
    }
}