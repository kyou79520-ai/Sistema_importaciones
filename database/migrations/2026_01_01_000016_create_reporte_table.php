<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reporte', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nombre_reporte');
            $table->string('titulo');
            $table->string('ruta_archivo')->nullable();
            $table->enum('formato', ['PDF','Excel','CSV','HTML'])->default('PDF');
            $table->json('parametros')->nullable();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }
    public function down(): void { Schema::dropIfExists('reporte'); }
};
