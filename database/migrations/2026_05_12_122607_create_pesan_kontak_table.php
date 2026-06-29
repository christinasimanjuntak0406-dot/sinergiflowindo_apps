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
        Schema::create('pesan_kontak', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pengirim', 100);
        $table->string('email_pengirim', 100)->nullable();
        $table->string('subjek', 200)->nullable();
         $table->string('no_telp', 200)->nullable();
        $table->text('isi_pesan')->nullable();
        $table->enum('status', ['belum dibaca', 'sudah dibaca'])->default('belum dibaca');
        $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_kontak');
    }
};
