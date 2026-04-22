<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pago', function (Blueprint $table) {
            $table->id('id_pago');
            $table->unsignedBigInteger('id_importacion');
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('monto', 15, 2);
            $table->date('fecha_pago');
            $table->string('metodo_pago');
            $table->string('num_comprobante')->nullable();
            $table->string('moneda', 10)->default('MXN');
            $table->timestamps();
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }
    public function down(): void { Schema::dropIfExists('pago'); }
};
