<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $fillable = [

        'isss',
        'afp',
        'techo_afp',
        'techo_isss'

    ];
}