<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documento', function (Blueprint $table) {
            $table->id('id_documento');
            $table->unsignedBigInteger('id_importacion')->nullable();
            $table->unsignedBigInteger('id_usuario_sube');
            $table->unsignedBigInteger('id_usuario_valida')->nullable();
            $table->enum('tipo_documento', ['factura','pedimento','BL','packing_list','certificado_origen','otro']);
            $table->string('ruta_archivo');
            $table->boolean('validado')->default(false);
            $table->timestamp('fecha_validacion')->nullable();
            $table->timestamps();
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->nullOnDelete();
            $table->foreign('id_usuario_sube')->references('id_usuario')->on('usuario');
            $table->foreign('id_usuario_valida')->references('id_usuario')->on('usuario')->nullOnDelete();
        });
    }
    public function down(): void { Schema::dropIfExists('documento'); }
};
