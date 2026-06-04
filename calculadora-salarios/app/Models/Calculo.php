<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Calculo extends Model
{
    protected $table = 'calculos';

    protected $fillable = [
    'user_id',
    'salario_base',
    'isss',
    'afp',
    'renta',
    'salario_neto',
    'aguinaldo',
    'vacaciones',
    'renuncia_voluntaria',
    'indemnizacion',
    'tipo_calculo'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}

