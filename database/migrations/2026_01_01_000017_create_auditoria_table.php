<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('auditoria', function (Blueprint $table) {
            $table->id('id_auditoria');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->string('accion');
            $table->string('tabla_afectada');
            $table->json('valores_anteriores')->nullable();
            $table->json('valores_nuevos')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('fecha_hora')->useCurrent();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->nullOnDelete();
        });
    }
    public function down(): void { Schema::dropIfExists('auditoria'); }
};
