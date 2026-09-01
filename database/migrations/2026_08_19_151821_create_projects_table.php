<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título del proyecto
            $table->text('description'); // Descripción del proyecto
            $table->string('image_path')->nullable(); // Ruta de la foto
            $table->string('encargado'); // Nombre del encargado
            $table->string('modelo_3d_ruta')->nullable(); // Ruta del modelo 3D
            $table->boolean('es_destacado')->default(0)->after('modelo_3d_ruta'); // Indica si el proyecto es destacado (1) o no (0)
            $table->timestamps(); // Esto crea las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['encargado', 'modelo_3d_ruta', 'es_destacado']);
        });
    }
};
