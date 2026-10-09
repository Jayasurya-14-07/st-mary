<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registration_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('course_title_dates');
            $table->string('name');
            $table->string('email');
            $table->text('contact_address');
            $table->string('phone');
            $table->string('country');
            $table->date('date_of_birth');
            $table->string('diocese_congregation');
            $table->string('religious_theological_non_academic');
            $table->text('religious_theological_academic');
            $table->text('secular')->nullable();
            $table->text('present_ministry');
            $table->text('interests')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_submissions');
    }
};
