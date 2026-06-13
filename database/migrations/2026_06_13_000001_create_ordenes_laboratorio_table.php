<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes_laboratorio', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('paciente_nombre');
            $table->enum('estado', ['pendiente', 'completado', 'entregado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes_laboratorio');
    }
};
