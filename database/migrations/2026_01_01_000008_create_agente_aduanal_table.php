<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('agente_aduanal', function (Blueprint $table) {
            $table->id('id_agente');
            $table->string('nombre_agente');
            $table->string('num_patente')->unique();
            $table->string('aduana_adscrita');
            $table->string('telefono')->nullable();
            $table->string('RFC_agente', 13)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('agente_aduanal'); }
};
