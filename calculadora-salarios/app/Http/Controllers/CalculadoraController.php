<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\Calculo;

class CalculadoraController extends Controller
{
    private const ISSS = 0.03;
    private const AFP = 0.0725;
    private const TECHO_AFP = 7045.06;
    private const TECHO_ISSS = 1000.00;

    public function index() {
        return view('salario');
    }

    public function prestacionesIndex() {
        return view('prestaciones');
    }
    

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

        $nombre = $request->nombre;
        $salarioBase = (float)$request->salarioBase;
        $bono = (float)$request->bonoMensual;
        $horasExtra = (float)$request->horasExtra;
        $frecuencia = $request->frecuencia;
        $descuentosAdicionales = (float)$request->descuentosAdicionales;

        $salarioQuincenal = $salarioBase / 2;
        $horaExtraPagar = $horasExtra > 0 ? (($salarioBase / 30) / 8) * 2 * $horasExtra : 0;

        if ($frecuencia === 'mensual') {
            $ingresoTotal = $salarioBase + $bono + $horaExtraPagar;
            $descuentoAFP = min($ingresoTotal, self::TECHO_AFP) * self::AFP;
            $descuentoISSS = min($ingresoTotal, self::TECHO_ISSS) * self::ISSS;
            
            $rentaNoGravada = $ingresoTotal - $descuentoAFP - $descuentoISSS;
            $descuentoISR = $this->calcularISRMensual($rentaNoGravada);
            
            $salarioLiquido = $ingresoTotal - $descuentoAFP - $descuentoISSS - $descuentoISR - $descuentosAdicionales;
        } else {

            $ingresoTotal = $salarioQuincenal + $bono + $horaExtraPagar;
            $descuentoAFP = min($ingresoTotal, self::TECHO_AFP) * self::AFP;
            $descuentoISSS = ($salarioBase <= self::TECHO_ISSS) ? ($ingresoTotal * self::ISSS) : (self::TECHO_ISSS * self::ISSS) / 2;
            
            $rentaNoGravada = $ingresoTotal - $descuentoAFP - $descuentoISSS;
            $descuentoISR = $this->calcularISRQuincenal($rentaNoGravada);
            
            $salarioLiquido = $ingresoTotal - $descuentoAFP - $descuentoISSS - $descuentoISR - $descuentosAdicionales;
        }

        Calculo::create([
    'salario_base' => $salarioBase,
    'isss' => $descuentoISSS,
    'afp' => $descuentoAFP,
    'renta' => $descuentoISR,
    'salario_neto' => $salarioLiquido,
    'tipo_calculo' => 'salario'
]);

        return view('salario', compact('nombre', 'salarioBase', 'salarioQuincenal', 'bono', 'horaExtraPagar', 'descuentoAFP', 'descuentoISSS', 'descuentoISR', 'descuentosAdicionales', 'salarioLiquido', 'frecuencia'));
    }

    private function calcularISRMensual($renta) {
        if ($renta <= 550.00) return 0;
        if ($renta <= 895.24) return (($renta - 550.00) * 0.10) + 17.67;
        if ($renta <= 2038.10) return (($renta - 895.24) * 0.20) + 60.00;
        return (($renta - 2038.10) * 0.30) + 288.57;
    }

    private function calcularISRQuincenal($renta) {
        if ($renta <= 275.00) return 0;
        if ($renta <= 447.62) return (($renta - 275.00) * 0.10) + 8.83;
        if ($renta <= 1019.05) return (($renta - 447.62) * 0.20) + 30.00;
        return (($renta - 1019.05) * 0.30) + 144.28;
    }

    public function calcularPrestaciones(Request $request)
    {
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'salarioBase' => 'required|numeric|min:0',
        ]);

        $salario = (float)$request->salarioBase;
        $fi = new DateTime($request->fechaInicio);
        $ff = new DateTime($request->fechaFin);
        $diferenciaDias = $fi->diff($ff)->days;


        if ($diferenciaDias < 365) {
            $aguinaldo = ($salario / 30) * ($diferenciaDias / 365) * 15; // Proporcional base 15 días
        } elseif ($diferenciaDias <= 1095) {
            $aguinaldo = ($salario / 30) * 15;
        } elseif ($diferenciaDias <= 3650) {
            $aguinaldo = ($salario / 30) * 19;
        } else {
            $aguinaldo = ($salario / 30) * 21;
        }


        $vacaciones = (($salario / 30) * 15) * 0.30;

        $salarioMinimo2 = 817.60; 
        if ($diferenciaDias >= 730) {
            $baseCalculo = min($salario, $salarioMinimo2);
            $renunciaVoluntaria = (($baseCalculo / 30) * 15) * ($diferenciaDias / 365);
        } else {
            $renunciaVoluntaria = 0;
        }

        $salarioMinimo4 = 1635.20;
        $baseIndemnizacion = min($salario, $salarioMinimo4);
        $indemnizacion = $baseIndemnizacion * ($diferenciaDias / 365);

        Calculo::create([
    'salario_base' => $salario,
    'aguinaldo' => $aguinaldo,
    'vacaciones' => $vacaciones,
    'indemnizacion' => $indemnizacion,
    'tipo_calculo' => 'prestaciones'
]);

        return view('prestaciones', compact('diferenciaDias', 'aguinaldo', 'vacaciones', 'renunciaVoluntaria', 'indemnizacion'));
    }

    public function historial()
{
    $calculos = Calculo::orderBy('created_at', 'desc')->get();

    return view('historial', compact('calculos'));
}

public function edit($id)
{
    $calculo = Calculo::findOrFail($id);

    return view('editarHistorial', compact('calculo'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'salario_base' => 'required|numeric|min:0'
    ]);

    $calculo = Calculo::findOrFail($id);

    $calculo->update([
        'salario_base' => $request->salario_base
    ]);

    return redirect()
        ->route('historial')
        ->with('success','Registro actualizado');
}

public function destroy($id)
{
    $calculo = Calculo::findOrFail($id);

    $calculo->delete();

    return redirect()
        ->route('historial')
        ->with('success','Registro eliminado');
}
}

