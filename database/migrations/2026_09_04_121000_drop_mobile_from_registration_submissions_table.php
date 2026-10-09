<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('registration_submissions', function (Blueprint $table) {
            if (Schema::hasColumn('registration_submissions', 'mobile')) {
                $table->dropColumn('mobile');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registration_submissions', function (Blueprint $table) {
            if (! Schema::hasColumn('registration_submissions', 'mobile')) {
                $table->string('mobile')->nullable()->after('phone');
            }
        });
    }
};
