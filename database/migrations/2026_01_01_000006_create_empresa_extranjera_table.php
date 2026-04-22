<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('empresa_extranjera', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('nombre_empresa');
            $table->string('pais_origen');
            $table->string('contacto')->nullable();
            $table->string('moneda_default', 10)->default('USD');
            $table->string('num_tax_id')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('empresa_extranjera'); }
};
