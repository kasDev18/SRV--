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
        Schema::table('candidates', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->nullable()->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->longText('topic')->nullable()->change();
            $table->unsignedInteger('customer_id')->nullable()->change();
            $table->integer('week_number')->nullable()->change();
            $table->integer('year')->nullable()->change();
            $table->unsignedInteger('position_id')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->integer('demand')->nullable()->change();
            $table->boolean('is_active')->nullable()->change();
            $table->boolean('is_deleted')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
