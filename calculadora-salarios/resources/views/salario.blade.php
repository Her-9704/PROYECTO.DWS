<x-app-layout>

<x-slot name="header">
    Calculadora Salarial
</x-slot>

<div class="grid lg:grid-cols-2 gap-8">

    <!-- FORMULARIO -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        @if ($errors->any())

            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-6">

                <strong>Corrige lo siguiente:</strong>

                <ul class="mt-2 list-disc list-inside">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('salario.calcular') }}"
              method="POST"
              class="space-y-5">

            @csrf

            <!-- Nombre -->

            <div>

                <label class="block mb-2 font-medium">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre') }}"
                       class="w-full border rounded-xl p-3"
                       required>

            </div>

            <!-- Salario -->

            <div>

                <label class="block mb-2 font-medium">
                    Salario Base ($)
                </label>

                <input type="number"
                       name="salarioBase"
                       step="0.01"
                       value="{{ old('salarioBase') }}"
                       class="w-full border rounded-xl p-3"
                       required>

            </div>

            <!-- Bono -->

            <div>

                <label class="block mb-2 font-medium">
                    Bono Mensual ($)
                </label>

                <input type="number"
                       name="bonoMensual"
                       step="0.01"
                       value="{{ old('bonoMensual',0) }}"
                       class="w-full border rounded-xl p-3">

            </div>

            <!-- Horas Extra -->

            <div>

                <label class="block mb-2 font-medium">
                    Horas Extra
                </label>

                <input type="number"
                       name="horasExtra"
                       step="0.01"
                       value="{{ old('horasExtra',0) }}"
                       class="w-full border rounded-xl p-3">

            </div>

            <!-- DESCUENTOS ADICIONALES -->

            <div>

                <label class="block mb-2 font-medium">
                    Descuentos adicionales ($)
                </label>

                <input type="number"
                       name="descuentosAdicionales"
                       step="0.01"
                       value="{{ old('descuentosAdicionales',0) }}"
                       class="w-full border rounded-xl p-3">

            </div>

            <!-- Frecuencia -->

            <div>

                <label class="block mb-3 font-medium">
                    Frecuencia
                </label>

                <div class="flex gap-6">

                    <label class="flex items-center gap-2">

                        <input type="radio"
                               name="frecuencia"
                               value="mensual"
                               {{ old('frecuencia','mensual') == 'mensual' ? 'checked' : '' }}>

                        Mensual

                    </label>

                    <label class="flex items-center gap-2">

                        <input type="radio"
                               name="frecuencia"
                               value="quincenal"
                               {{ old('frecuencia') == 'quincenal' ? 'checked' : '' }}>

                        Quincenal

                    </label>

                </div>

            </div>

            <!-- BOTON -->

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">

                Calcular Salario

            </button>

        </form>

    </div>

    <!-- RESULTADOS -->

    <div class="bg-slate-900 text-white rounded-2xl p-8">

        <h2 class="text-2xl font-bold mb-6">

            Resultado

        </h2>

        @if(isset($salarioLiquido))

            <div class="space-y-4">

                <p>
                    Empleado:
                    <strong>{{ $nombre }}</strong>
                </p>

                <p>
                    Salario Base:
                    ${{ number_format($salarioBase,2) }}
                </p>

                <p>
                    Bono:
                    ${{ number_format($bono,2) }}
                </p>

                <p>
                    Horas Extra:
                    ${{ number_format($horaExtraPagar,2) }}
                </p>

                <hr class="border-slate-700">

                <p>
                    AFP:
                    ${{ number_format($descuentoAFP,2) }}
                </p>

                <p>
                    ISSS:
                    ${{ number_format($descuentoISSS,2) }}
                </p>

                <p>
                    ISR:
                    ${{ number_format($descuentoISR,2) }}
                </p>

                <p>
                    Descuentos adicionales:
                    ${{ number_format($descuentosAdicionales,2) }}
                </p>

                <div class="bg-emerald-600 rounded-xl p-5 mt-5">

                    <span class="text-lg">

                        Salario líquido ({{ $frecuencia }})

                    </span>

                    <h3 class="text-3xl font-bold mt-2">

                        ${{ number_format($salarioLiquido,2) }}

                    </h3>

                </div>

            </div>

        @else

            <p class="text-slate-300">

                Ingresa los datos para realizar el cálculo.

            </p>

        @endif

    </div>

</div>

</x-app-layout>