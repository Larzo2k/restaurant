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
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('cod');
            $table->string('cod_barra')->default('');
            $table->string('description');
            $table->string('image')->default('');
            $table->string('stock')->default('');
            $table->string('diametro')->default('');
            $table->string('longitud')->default('');
            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('category');
            $table->uuid('wherehouse_id');
            $table->foreign('wherehouse_id')->references('id')->on('wherehouse');
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};