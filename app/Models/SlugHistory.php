<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlugHistory extends Model
{
    protected $fillable = [
        'old_slug',
        'sluggable_type',
        'sluggable_id',
    ];

    public function sluggable()
    {
        return $this->morphTo();
    }
}
