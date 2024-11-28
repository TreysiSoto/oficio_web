<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->date('fecha_publicacion');
            $table->string('estado', 50)->default('Disponible');
            $table->foreignId('empleador_id')->constrained('empleadores');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('publicaciones');
    }
};
