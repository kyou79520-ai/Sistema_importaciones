<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('empresa_extranjera')) return;

        Schema::create('empresa_extranjera', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('nombre_empresa', 200);
            $table->string('pais_origen', 100);
            $table->string('moneda_default', 10)->nullable()->default('USD');
            $table->string('num_tax_id', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('empresa_extranjera'); }
};
