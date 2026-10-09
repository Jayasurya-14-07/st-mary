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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('author')->nullable();
            $table->json('content')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('order_by')->nullable();
            $table->date('publish_date')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};