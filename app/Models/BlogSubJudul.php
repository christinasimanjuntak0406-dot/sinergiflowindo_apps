<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSubJudul extends Model
{
    protected $table = 'blog_sub_judul';

    protected $fillable = [
        'blog_id',
        'sub_judul',
        'sub_konten',
        'urutan',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}