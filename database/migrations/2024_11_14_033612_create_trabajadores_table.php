<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 15)->unique();
            $table->string('direccion', 200)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('trabajo', 100);
            $table->string('antecedentes', 100)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('trabajadores');
    }
};
