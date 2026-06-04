<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('descuentos', function (Blueprint $table) {

            $table->id();

            $table->decimal('isss',8,4)
                ->default(0.03);

            $table->decimal('afp',8,4)
                ->default(0.0725);

            $table->decimal('techo_afp',10,2)
                ->default(7045.06);

            $table->decimal('techo_isss',10,2)
                ->default(1000.00);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('descuentos');
    }
};
