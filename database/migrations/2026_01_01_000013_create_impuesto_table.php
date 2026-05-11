<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('impuesto', function (Blueprint $table) {
            $table->id('id_impuesto');
            $table->unsignedBigInteger('id_importacion');
            $table->enum('tipo_impuesto', ['IGI','IVA','DTA','PRV','IEPS','otro']);
            $table->decimal('base_imponible', 15, 2);
            $table->decimal('tasa_porcentaje', 6, 4);
            $table->decimal('monto', 15, 2);
            $table->timestamps();
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('impuesto'); }
};
