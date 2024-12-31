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
        Schema::create('venta', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Clave primaria 'id' de tipo UUID
            $table->date('fecha');
            $table->double('total');
            $table->uuid('customer_id');  // Clave foránea 'customer_id' de tipo UUID
            $table->uuid('user_id');     // Clave foránea 'user_id' de tipo UUID
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};