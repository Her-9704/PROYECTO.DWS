<x-app-layout>

<x-slot name="header">
    Calculadora de Prestaciones
</x-slot>

<div class="grid lg:grid-cols-2 gap-8">

    <!-- FORMULARIO -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6 text-slate-800">

            Datos Laborales

        </h2>

        <form action="{{ route('prestaciones.calcular') }}"
              method="POST"
              class="space-y-5">

            @csrf

            <div>

                <label class="block mb-2 font-medium text-slate-700">

                    Fecha de inicio en la empresa

                </label>

                <input
                    type="date"
                    name="fechaInicio"
                    value="{{ old('fechaInicio') }}"
                    required
                    class="w-full border rounded-xl p-3">

                @error('fechaInicio')

                    <p class="text-red-500 text-sm mt-1">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <div>

                <label class="block mb-2 font-medium text-slate-700">

                    Fecha finalización (o actual)

                </label>

                <input
                    type="date"
                    name="fechaFin"
                    value="{{ old('fechaFin') }}"
                    class="w-full border rounded-xl p-3">

                <small class="text-gray-500">

                    Déjalo vacío si continúa trabajando

                </small>

            </div>

            <div>

                <label class="block mb-2 font-medium text-slate-700">

                    Salario base mensual ($)

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="salarioBase"
                    value="{{ old('salarioBase') }}"
                    required
                    class="w-full border rounded-xl p-3">

                @error('salarioBase')

                    <p class="text-red-500 text-sm mt-1">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700">

                Calcular Prestaciones

            </button>

        </form>

    </div>


    <!-- RESULTADOS -->

    <div class="bg-slate-900 text-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6">

            Resumen de prestaciones:

        </h2>

        @if(isset($dias))

            <div class="space-y-4">

                <div class="bg-slate-800 rounded-xl p-4">

                    Tiempo laborado:

                    <strong>

                        {{ $dias }} días

                    </strong>

                </div>

                <div class="bg-emerald-600 rounded-xl p-4">

                    Aguinaldo:

                    <strong>

                        ${{ number_format($aguinaldo,2) }}

                    </strong>

                </div>

                <div class="bg-blue-600 rounded-xl p-4">

                    Vacaciones:

                    <strong>

                        ${{ number_format($vacaciones,2) }}

                    </strong>

                </div>

                <div class="bg-yellow-500 text-black rounded-xl p-4">

                    Renuncia voluntaria:

                    <strong>

                        ${{ number_format($renunciaVoluntaria,2) }}

                    </strong>

                </div>

                <div class="bg-red-500 rounded-xl p-4">

                    Indemnización:

                    <strong>

                        ${{ number_format($indemnizacion,2) }}

                    </strong>

                </div>

            </div>

        @else

            <div class="text-slate-300">

                Complete los datos laborales para generar el cálculo.

            </div>

        @endif

    </div>

</div>

</x-app-layout>