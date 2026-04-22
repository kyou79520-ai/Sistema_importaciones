<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('empresa_importadora', function (Blueprint $table) {
            $table->id('id_empresa_mx');
            $table->string('RFC_empresa', 13)->unique();
            $table->string('razon_social');
            $table->boolean('padron_importadores')->default(false);
            $table->string('giro_comercial')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('empresa_importadora'); }
};
