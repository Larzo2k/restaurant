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
        Schema::create('compra', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('fecha');
            $table->double('total');
            $table->uuid('supplier_id'); // Declarar como UUID
            $table->uuid('user_id');    // Declarar como UUID
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();

            // Definir las relaciones foráneas
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra');
    }
};