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
        Schema::create('candidate_languages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('candidate_id')->contraints()->index();
            $table->unsignedInteger('language_id')->contraints();
            $table->unsignedInteger('language_level_id')->contraints();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_languages');
    }
};
