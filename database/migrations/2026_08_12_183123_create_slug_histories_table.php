<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slug_histories', function (Blueprint $table) {
            $table->id();
            $table->string('old_slug')->index();
            $table->morphs('sluggable');
            $table->timestamps();

            $table->unique(['old_slug', 'sluggable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slug_histories');
    }
};
