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
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('compra_id'); // Declarar como UUID
            $table->uuid('product_id'); // Declarar como UUID
            $table->integer('cantidad');
            $table->double('subtotal');
            $table->double('precio_compra');
            $table->double('precio_venta');
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();

            // Definir las relaciones foráneas
            $table->foreign('compra_id')->references('id')->on('compra');
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_compra');
    }
};