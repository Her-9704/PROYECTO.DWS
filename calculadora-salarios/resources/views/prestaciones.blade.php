<x-app-layout>

<x-slot name="header">
    Calculadora de Prestaciones
</x-slot>

<div class="grid lg:grid-cols-2 gap-8">

    <!-- Formulario -->
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6 text-slate-800">
            Datos Laborales
        </h2>

        <form action="{{ route('prestaciones.calcular') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-2 font-medium text-slate-700">
                    Fecha de inicio
                </label>

                <input
                    type="date"
                    name="fechaInicio"
                    value="{{ old('fechaInicio') }}"
                    required

                    class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 font-medium text-slate-700">
                    Fecha finalización / actual
                </label>

                <input
                    type="date"
                    name="fechaFin"
                    value="{{ old('fechaFin') }}"
                    required

                    class="w-full border rounded-xl p-3">
            </div>

            <div>
                <label class="block mb-2 font-medium text-slate-700">
                    Salario mensual
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="salarioBase"
                    value="{{ old('salarioBase') }}"
                    required

                    class="w-full border rounded-xl p-3">
            </div>

            <button
                class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700">

                Calcular Prestaciones

            </button>

        </form>

    </div>


    <!-- Resultados -->

    <div class="bg-slate-900 text-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold mb-6">
            Resultados
        </h2>

        @if(isset($diferenciaDias))

            <div class="space-y-4">

                <div class="bg-slate-800 rounded-xl p-4">
                    Tiempo laborado:
                    <strong>{{ $diferenciaDias }} días</strong>
                </div>

                <div class="bg-emerald-600 rounded-xl p-4">
                    Aguinaldo:
                    <strong>${{ number_format($aguinaldo,2) }}</strong>
                </div>

                <div class="bg-blue-600 rounded-xl p-4">
                    Vacaciones:
                    <strong>${{ number_format($vacaciones,2) }}</strong>
                </div>

                <div class="bg-yellow-500 rounded-xl p-4 text-black">
                    Renuncia voluntaria:
                    <strong>${{ number_format($renunciaVoluntaria,2) }}</strong>
                </div>

                <div class="bg-red-500 rounded-xl p-4">
                    Indemnización:
                    <strong>${{ number_format($indemnizacion,2) }}</strong>
                </div>

            </div>

        @else

            <p class="text-slate-300">
                Completa el formulario para calcular prestaciones.
            </p>

        @endif

    </div>

</div>

</x-app-layout>