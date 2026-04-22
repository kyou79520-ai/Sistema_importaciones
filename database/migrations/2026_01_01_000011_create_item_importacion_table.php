<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('item_importacion', function (Blueprint $table) {
            $table->id('id_item');
            $table->unsignedBigInteger('id_importacion');
            $table->integer('numero_linea');
            $table->string('descripcion');
            $table->decimal('cantidad', 15, 4);
            $table->string('unidad_medida', 20)->default('PZA');
            $table->decimal('valor_unitario', 15, 4);
            $table->decimal('valor_total', 15, 2)->nullable();
            $table->decimal('peso_kg', 15, 4)->nullable();
            $table->string('codigo_hs', 20)->nullable();
            $table->timestamps();
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('item_importacion'); }
};
