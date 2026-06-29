<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    use HasFactory;

    protected $table = 'pesan_kontak';

    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'nomor_telepon',
        'subjek',
        'isi_pesan',
        'status',
    ];

    public $timestamps = false;
}