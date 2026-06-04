<?php

namespace App\Http\Controllers;

use App\Models\Descuento;
use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    public function index()
    {
        $descuento =
            Descuento::first();

        return view(
            'descuentos',
            compact('descuento')
        );
    }

    public function update(Request $request)
    {
        $request->validate([

            'isss'=>'required|numeric',
            'afp'=>'required|numeric',
            'techo_afp'=>'required|numeric',
            'techo_isss'=>'required|numeric'

        ]);

        $descuento =
            Descuento::first();

        $descuento->update(
            $request->all()
        );

        return back()
            ->with(
                'success',
                'Descuentos actualizados'
            );
    }
}