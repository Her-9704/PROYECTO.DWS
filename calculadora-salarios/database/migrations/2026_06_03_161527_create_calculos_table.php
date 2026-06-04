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
    Schema::create('calculos', function (Blueprint $table) {

        $table->id();

        $table->decimal('salario_base',10,2);

        $table->decimal('isss',10,2)->nullable();

        $table->decimal('afp',10,2)->nullable();

        $table->decimal('renta',10,2)->nullable();

        $table->decimal('salario_neto',10,2)->nullable();

        $table->decimal('aguinaldo',10,2)->nullable();

        $table->decimal('vacaciones',10,2)->nullable();

        $table->decimal('indemnizacion',10,2)->nullable();

        $table->string('tipo_calculo');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('calculos');
}
};
