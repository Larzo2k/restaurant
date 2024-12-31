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
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Clave primaria 'id' de tipo UUID
            $table->uuid('venta_id');  // 'venta_id' debe ser de tipo UUID
            $table->uuid('product_id'); // 'product_id' debe ser de tipo UUID
            $table->integer('cantidad');
            $table->double('subtotal');
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();

            // Relación con la tabla 'venta'
            $table->foreign('venta_id')->references('id')->on('venta');

            // Relación con la tabla 'product'
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
    }
};