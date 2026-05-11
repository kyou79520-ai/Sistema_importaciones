<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        if (!Schema::hasTable('pago')) {
            Schema::create('pago', function (Blueprint $table) {
                $table->id('id_pago');
                $table->unsignedBigInteger('id_importacion');
                $table->unsignedBigInteger('id_usuario');
                $table->decimal('monto', 15, 2);
                $table->date('fecha_pago');
                $table->string('metodo_pago');
                $table->string('num_comprobante', 100)->nullable();
                $table->string('moneda', 10)->default('MXN');
                $table->timestamps();
                $table->foreign('id_importacion')->references('id_importacion')
                      ->on('importacion')->onDelete('cascade');
                $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            });
        }

        if (!Schema::hasTable('costo_importacion')) {
            Schema::create('costo_importacion', function (Blueprint $table) {
                $table->id('id_costo');
                $table->unsignedBigInteger('id_importacion');
                $table->string('concepto');
                $table->decimal('monto', 15, 2);
                $table->string('moneda', 10)->default('MXN');
                $table->text('descripcion')->nullable();
                $table->timestamps();
                $table->foreign('id_importacion')->references('id_importacion')
                      ->on('importacion')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('costo_importacion');
        Schema::dropIfExists('pago');
        Schema::dropIfExists('impuesto');
    }
};
