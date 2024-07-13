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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('cost_of_accommodation')->nullable();
            $table->integer('cost_of_insurance')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('brutto')->nullable();
            $table->boolean('netto')->nullable();
            $table->string('payout_system')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('sector_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->boolean('age_rate')->nullable();
            $table->boolean('without_language')->nullable();
            $table->boolean('is_active')->nullable();
            $table->longText('job_description')->nullable();
            $table->longText('we_offer')->nullable();
            $table->longText('requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
