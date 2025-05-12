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
        Schema::create('daily_menu_product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('quantity');
            $table->integer('stock');
            $table->uuid('daily_menu_id');
            $table->uuid('product_id');
            $table->foreign('daily_menu_id')->references('id')->on('daily_menus');
            $table->foreign('product_id')->references('id')->on('product');
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_menu_product');
    }
};