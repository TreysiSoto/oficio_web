<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('opiniones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleador_id')->constrained('empleadores');
            $table->foreignId('trabajador_id')->constrained('trabajadores');
            $table->integer('calificacion')->checkBetween(1, 5);
            $table->text('mensaje')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('opiniones');
    }
};
