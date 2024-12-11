<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('excel_coordinates', function (Blueprint $table) {
        $table->id();
        $table->string('column'); // Columna (A, B, C, ...)
        $table->integer('row');   // Fila (1, 2, 3, ...)
        $table->timestamps();
    });

    // Migración para los datos de las celdas
    Schema::create('excel_data', function (Blueprint $table) {
        $table->id();
        $table->foreignId('coordinate_id')->constrained('excel_coordinates'); // Relación con la tabla excel_coordinates
        $table->text('value')->nullable();  // Valor de la celda
        $table->timestamps();
    });
}
};
