<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->text('deskripsi_singkat')->nullable()->after('deskripsi');
            $table->json('highlight_tags')->nullable();
            $table->json('keunggulan_list')->nullable();
            $table->json('spesifikasi_json')->nullable();
            $table->json('aplikasi_list')->nullable();
            $table->json('gallery_badges')->nullable();
            $table->string('datasheet_file')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn([
                'gambar2', 'gambar3', 'gambar4',
                'deskripsi_singkat',
                'highlight_tags',
                'keunggulan_list',
                'spesifikasi_json',
                'aplikasi_list',
                'gallery_badges',
                'datasheet_file',
            ]);
        });
    }
};