<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Informasi dasar
            if (!Schema::hasColumn('produk', 'slug'))
                $table->string('slug', 200)->unique()->nullable()->after('nama_produk');
            if (!Schema::hasColumn('produk', 'model_number'))
                $table->string('model_number', 100)->nullable()->after('slug');
            if (!Schema::hasColumn('produk', 'model_subtitle'))
                $table->string('model_subtitle', 200)->nullable()->after('model_number');

            // Dimensi
            if (!Schema::hasColumn('produk', 'dim_width'))
                $table->string('dim_width', 50)->nullable();
            if (!Schema::hasColumn('produk', 'dim_height'))
                $table->string('dim_height', 50)->nullable();
            if (!Schema::hasColumn('produk', 'dim_depth'))
                $table->string('dim_depth', 50)->nullable();
            if (!Schema::hasColumn('produk', 'gambar_dimensi'))
                $table->string('gambar_dimensi')->nullable();

            // Video
            if (!Schema::hasColumn('produk', 'video_judul'))
                $table->string('video_judul')->nullable();
            if (!Schema::hasColumn('produk', 'video_url'))
                $table->string('video_url')->nullable();

            // JSON fields
            if (!Schema::hasColumn('produk', 'highlight_specs'))
                $table->json('highlight_specs')->nullable();
            if (!Schema::hasColumn('produk', 'highlight_tags'))
                $table->json('highlight_tags')->nullable();
            if (!Schema::hasColumn('produk', 'keunggulan_list'))
                $table->json('keunggulan_list')->nullable();
            if (!Schema::hasColumn('produk', 'spesifikasi_json'))
                $table->json('spesifikasi_json')->nullable();
            if (!Schema::hasColumn('produk', 'gallery_badges'))
                $table->json('gallery_badges')->nullable();
            if (!Schema::hasColumn('produk', 'aplikasi_list'))
                $table->json('aplikasi_list')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $columns = [
                'slug', 'model_number', 'model_subtitle',
                'dim_width', 'dim_height', 'dim_depth', 'gambar_dimensi',
                'video_judul', 'video_url',
                'highlight_specs', 'highlight_tags', 'keunggulan_list',
                'spesifikasi_json', 'gallery_badges', 'aplikasi_list',
            ];

            $existing = array_filter($columns, fn($col) => Schema::hasColumn('produk', $col));
            if (!empty($existing)) {
                $table->dropColumn(array_values($existing));
            }
        });
    }
};