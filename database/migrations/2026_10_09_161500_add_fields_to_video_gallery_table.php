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
        Schema::table('video_gallery', function (Blueprint $table) {
            $table->date('publish_date')->nullable()->default(now());
            $table->integer('order_by')->default(0);
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_gallery', function (Blueprint $table) {
            $table->dropColumn(['publish_date', 'order_by', 'status']);
        });
    }
};
