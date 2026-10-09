<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photo_gallery_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_gallery_id')->constrained()->onDelete('cascade');
            $table->foreignId('media_id')->constrained('curator')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_gallery_media');
    }
};
