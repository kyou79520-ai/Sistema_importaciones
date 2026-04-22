<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('log_sistema_externo', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_importacion')->nullable();
            $table->string('sistema_nombre');
            $table->string('tipo_operacion');
            $table->enum('estado', ['exitoso','fallido','pendiente'])->default('pendiente');
            $table->text('mensaje_respuesta')->nullable();
            $table->timestamp('fecha_sincronizacion')->useCurrent();
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->nullOnDelete();
        });
    }
    public function down(): void { Schema::dropIfExists('log_sistema_externo'); }
};
