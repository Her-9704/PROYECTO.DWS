<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\Calculo;
use App\Models\Descuento;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('salario');
    }

    public function prestacionesIndex()
    {
        return view('prestaciones');
    }

    /*
    |--------------------------------------------------------------------------
    | CALCULO SALARIO
    |--------------------------------------------------------------------------
    */

    public function calcularSalario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'salarioBase' => 'required|numeric|min:0',
            'bonoMensual' => 'required|numeric|min:0',
            'horasExtra' => 'required|numeric|min:0',
            'descuentosAdicionales' => 'required|numeric|min:0',
            'frecuencia' => 'required|in:mensual,quincenal',
        ]);

        $config = Descuento::first();

        $nombre = $request->nombre;
        $salarioBase = (float)$request->salarioBase;
        $bono = (float)$request->bonoMensual;
        $horasExtra = (float)$request->horasExtra;
        $frecuencia = $request->frecuencia;
        $descuentosAdicionales = (float)$request->descuentosAdicionales;

        $salarioQuincenal = $salarioBase / 2;

        $horaExtraPagar =
            $horasExtra > 0
            ? (($salarioBase / 30) / 8) * 2 * $horasExtra
            : 0;

        if ($frecuencia === 'mensual') {

            $ingresoTotal =
                $salarioBase +
                $bono +
                $horaExtraPagar;

            $descuentoAFP =
                min($ingresoTotal, $config->techo_afp)
                * $config->afp;

            $descuentoISSS =
                min($ingresoTotal, $config->techo_isss)
                * $config->isss;

            $rentaNoGravada =
                $ingresoTotal
                - $descuentoAFP
                - $descuentoISSS;

            $descuentoISR =
                $this->calcularISRMensual($rentaNoGravada);

        } else {

            $ingresoTotal =
                $salarioQuincenal
                + $bono
                + $horaExtraPagar;

            $descuentoAFP =
                min($ingresoTotal, $config->techo_afp)
                * $config->afp;

            $descuentoISSS =
                ($salarioBase <= $config->techo_isss)
                ? ($ingresoTotal * $config->isss)
                : (($config->techo_isss * $config->isss) / 2);

            $rentaNoGravada =
                $ingresoTotal
                - $descuentoAFP
                - $descuentoISSS;

            $descuentoISR =
                $this->calcularISRQuincenal($rentaNoGravada);
        }

        $salarioLiquido =
            $ingresoTotal
            - $descuentoAFP
            - $descuentoISSS
            - $descuentoISR
            - $descuentosAdicionales;

        Calculo::create([

            'user_id' => auth()->id(),

            'salario_base' => $salarioBase,

            'isss' => $descuentoISSS,

            'afp' => $descuentoAFP,

            'renta' => $descuentoISR,

            'salario_neto' => $salarioLiquido,

            'tipo_calculo' => 'salario'

        ]);

        return view('salario', compact(

            'nombre',
            'salarioBase',
            'salarioQuincenal',
            'bono',
            'horaExtraPagar',
            'descuentoAFP',
            'descuentoISSS',
            'descuentoISR',
            'descuentosAdicionales',
            'salarioLiquido',
            'frecuencia'

        ));
    }

    private function calcularISRMensual($renta)
    {
        if ($renta <= 550) return 0;
        if ($renta <= 895.24) return (($renta - 550) * 0.10) + 17.67;
        if ($renta <= 2038.10) return (($renta - 895.24) * 0.20) + 60;
        return (($renta - 2038.10) * 0.30) + 288.57;
    }

    private function calcularISRQuincenal($renta)
    {
        if ($renta <= 275) return 0;
        if ($renta <= 447.62) return (($renta - 275) * 0.10) + 8.83;
        if ($renta <= 1019.05) return (($renta - 447.62) * 0.20) + 30;
        return (($renta - 1019.05) * 0.30) + 144.28;
    }

    /*
    |--------------------------------------------------------------------------
    | PRESTACIONES
    |--------------------------------------------------------------------------
    */

    public function calcularPrestaciones(Request $request)
    {
        $request->validate([

            'fechaInicio' => 'required|date',

            'fechaFin' =>
                'nullable|date|after_or_equal:fechaInicio',

            'salarioBase' =>
                'required|numeric|min:0'

        ]);

        $salario = (float)$request->salarioBase;

        $inicio = new DateTime($request->fechaInicio);

        $fin =
            $request->fechaFin
            ? new DateTime($request->fechaFin)
            : new DateTime();

        $dias =
            $inicio->diff($fin)->days;

        $anios =
            $dias / 365;

        if ($dias < 365) {

            $aguinaldo =
                ($salario / 30)
                * 15
                * $anios;

        } elseif ($dias <= 1095) {

            $aguinaldo =
                ($salario / 30) * 15;

        } elseif ($dias <= 3650) {

            $aguinaldo =
                ($salario / 30) * 19;

        } else {

            $aguinaldo =
                ($salario / 30) * 21;
        }

        $vacaciones =
            (($salario / 30) * 15)
            * 0.30;

        $renunciaVoluntaria = 0;

        if ($dias >= 730) {

            $base =
                min($salario, 817.60);

            $renunciaVoluntaria =
                (($base / 30) * 15)
                * $anios;
        }

        $baseIndemnizacion =
            min($salario, 1635.20);

        $indemnizacion =
            $baseIndemnizacion
            * $anios;

        Calculo::create([

            'user_id' => auth()->id(),

            'salario_base' => $salario,

            'aguinaldo' => $aguinaldo,

            'vacaciones' => $vacaciones,

            'renuncia_voluntaria' => $renunciaVoluntaria,

            'indemnizacion' => $indemnizacion,

            'tipo_calculo' => 'prestaciones'

        ]);

        return view('prestaciones', compact(

            'dias',

            'aguinaldo',

            'vacaciones',

            'renunciaVoluntaria',

            'indemnizacion'

        ));
    }

    /*
    |--------------------------------------------------------------------------
    | HISTORIAL
    |--------------------------------------------------------------------------
    */

    public function historial()
    {
        $calculos = Calculo::with('user')
            ->latest()
            ->get();

        return view('historial', compact('calculos'));
    }

    public function edit($id)
    {
        $calculo = Calculo::findOrFail($id);

        return view(
            'editarHistorial',
            compact('calculo')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'salario_base' =>
                'required|numeric|min:0'

        ]);

        $config = Descuento::first();

        $calculo =
            Calculo::findOrFail($id);

        $salario =
            (float)$request->salario_base;

        if($calculo->tipo_calculo == 'salario'){

            $afp =
                min($salario, $config->techo_afp)
                * $config->afp;

            $isss =
                min($salario, $config->techo_isss)
                * $config->isss;

            $renta =
                $this->calcularISRMensual(
                    $salario - $afp - $isss
                );

            $neto =
                $salario
                - $afp
                - $isss
                - $renta;

            $calculo->update([

                'salario_base' => $salario,

                'afp' => $afp,

                'isss' => $isss,

                'renta' => $renta,

                'salario_neto' => $neto

            ]);

        }else{

            $calculo->update([

                'salario_base' => $salario,

                'aguinaldo' =>
                    ($salario/30)*15,

                'vacaciones' =>
                    (($salario/30)*15)*0.30,

                'renuncia_voluntaria' =>
                    min($salario,817.60),

                'indemnizacion' =>
                    min($salario,1635.20)

            ]);
        }

        return redirect()
            ->route('historial')
            ->with(
                'success',
                'Registro actualizado'
            );
    }

    public function destroy($id)
    {
        Calculo::findOrFail($id)
            ->delete();

        return redirect()
            ->route('historial')
            ->with(
                'success',
                'Registro eliminado'
            );
    }
}