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
        Schema::table('orders', function (Blueprint $table) {
            $table->longText('topic');
            $table->unsignedInteger('customer_id');
            $table->integer('week_number');
            $table->integer('year');
            $table->unsignedInteger('position_id');
            $table->string('city');
            $table->integer('demand');
            $table->string('description');
            $table->boolean('is_active');
            $table->boolean('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
