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
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Clave primaria 'id' de tipo UUID
            $table->uuid('pedido_id');  // 'venta_id' debe ser de tipo UUID
            //$table->uuid('product_id'); // 'product_id' debe ser de tipo UUID
            $table->uuid('daily_menu_product_id');
            $table->integer('cantidad');
            $table->double('subtotal');
            $table->tinyInteger('status')->default(1)->comment('1=Activo, 0=Inactivo');
            $table->timestamps();

            // Relación con la tabla 'peddi'
            $table->foreign('pedido_id')->references('id')->on('pedido');

            // Relación con la tabla 'product'
            $table->foreign('daily_menu_product_id')->references('id')->on('daily_menu_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido');
    }
};
