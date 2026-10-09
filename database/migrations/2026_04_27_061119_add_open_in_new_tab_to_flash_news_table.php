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
        Schema::table('flash_news', function (Blueprint $table) {
            $table->boolean('open_in_new_tab')->default(false)->after('link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flash_news', function (Blueprint $table) {
            $table->dropColumn('open_in_new_tab');
        });
    }
};
