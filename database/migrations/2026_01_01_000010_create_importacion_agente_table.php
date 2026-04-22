<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('importacion_agente', function (Blueprint $table) {
            $table->unsignedBigInteger('id_importacion');
            $table->unsignedBigInteger('id_agente');
            $table->string('rol_agente')->nullable();
            $table->timestamp('asignado_en')->useCurrent();
            $table->primary(['id_importacion', 'id_agente']);
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->onDelete('cascade');
            $table->foreign('id_agente')->references('id_agente')->on('agente_aduanal')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('importacion_agente'); }
};
