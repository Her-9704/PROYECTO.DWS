<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{
    protected $table = 'calculos';

    protected $fillable = [
        'salario_base',
        'isss',
        'afp',
        'renta',
        'salario_neto',
        'tipo_calculo'
    ];
}