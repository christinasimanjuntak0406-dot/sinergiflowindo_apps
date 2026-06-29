<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('blog_sub_judul')) {
        Schema::create('blog_sub_judul', function (Blueprint $table) {
        $table->id();
        $table->foreignId('blog_id')->constrained('blog')->onDelete('cascade');
        $table->string('sub_judul');
        $table->text('sub_konten')->nullable();
        $table->integer('urutan')->default(0);
        $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_sub_judul');
    }
};
