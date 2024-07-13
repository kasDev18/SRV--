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
        Schema::table('offers', function (Blueprint $table) {
            $table->decimal('salary', 8, 2)->nullable()->change();
            $table->decimal('cost_of_accommodation', 8, 2)->nullable()->change();
            $table->decimal('cost_of_insurance', 8, 2)->nullable()->change();
            $table->decimal('cost_of_transport', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('decimals', function (Blueprint $table) {
            //
        });
    }
};
