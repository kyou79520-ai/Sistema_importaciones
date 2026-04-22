<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('costo_importacion', function (Blueprint $table) {
            $table->id('id_costo');
            $table->unsignedBigInteger('id_importacion');
            $table->enum('tipo_costo', ['flete','seguro','gastos_aduanales','honorarios','almacenaje','otro']);
            $table->decimal('seguro', 15, 2)->default(0);
            $table->decimal('gastos_aduanales', 15, 2)->default(0);
            $table->decimal('otros_gastos', 15, 2)->default(0);
            $table->decimal('total_costos', 15, 2)->default(0);
            $table->string('moneda', 10)->default('MXN');
            $table->timestamps();
            $table->foreign('id_importacion')->references('id_importacion')->on('importacion')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('costo_importacion'); }
};
