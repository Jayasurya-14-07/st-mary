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
        Schema::table('sliders', function (Blueprint $table) {
            if (! Schema::hasColumn('sliders', 'link_title')) {
                $table->string('link_title')->nullable()->after('description');
            }

            if (! Schema::hasColumn('sliders', 'link')) {
                $table->string('link')->nullable()->after('link_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            if (Schema::hasColumn('sliders', 'link')) {
                $table->dropColumn('link');
            }

            if (Schema::hasColumn('sliders', 'link_title')) {
                $table->dropColumn('link_title');
            }
        });
    }
};
