<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('importacion', function (Blueprint $table) {
            $table->id('id_importacion');
            $table->string('numero_importacion')->unique();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_empresa_mx')->nullable();
            $table->unsignedBigInteger('id_empresa_extranjera')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('pais_origen');
            $table->date('fecha_arribo')->nullable();
            $table->enum('estado', ['borrador','en_tramite','en_aduana','liberada','entregada','cancelada'])->default('borrador');
            $table->decimal('total_cif', 15, 2)->default(0);
            $table->decimal('total_impuestos', 15, 2)->default(0);
            $table->decimal('total_aduanales', 15, 2)->default(0);
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_empresa_mx')->references('id_empresa_mx')->on('empresa_importadora')->nullOnDelete();
            $table->foreign('id_empresa_extranjera')->references('id_empresa')->on('empresa_extranjera')->nullOnDelete();
        });
    }
    public function down(): void { Schema::dropIfExists('importacion'); }
};
