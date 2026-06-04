<x-app-layout>

    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-blue-500 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold">
                Calculadora Salarial
            </h3>

            <p class="mt-2 opacity-90">
                Calcula salarios líquidos y descuentos.
            </p>
        </div>

        <div class="bg-emerald-500 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold">
                Prestaciones
            </h3>

            <p class="mt-2 opacity-90">
                Aguinaldo, vacaciones e indemnización.
            </p>
        </div>

        <div class="bg-slate-800 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold">
                Historial
            </h3>

            <p class="mt-2 opacity-90">
                Consulta cálculos guardados.
            </p>
        </div>

    </div>

</x-app-layout>