<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre_usuario')->unique();
            $table->string('hash_contrasena');
            $table->string('nombre_completo');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->string('RFC', 13)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamp('fecha_creacion')->nullable();
		$table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('usuario'); }
};
