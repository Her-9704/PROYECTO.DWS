<x-app-layout>

<x-slot name="header">
    Historial de Cálculos
</x-slot>

<div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-screen-2xl mx-auto">

    <h2 class="text-2xl font-bold text-slate-800 mb-6">
        Historial General
    </h2>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5">

            {{ session('success') }}

        </div>

    @endif

    <div class="w-full">

        <table class="w-full table-auto text-sm">

            <thead class="bg-slate-900 text-white text-sm">

                <tr>

                    <th class="px-2 py-4">ID</th>

                    <th class="px-2">Usuario</th>

                    <th class="px-2">Tipo</th>

                    <th class="px-2">Base</th>

                    <th class="px-2">AFP</th>

                    <th class="px-2">ISSS</th>

                    <th class="px-2">Renta</th>

                    <th class="px-2">Neto</th>

                    <th class="px-2">Aguinaldo</th>

                    <th class="px-2">Vacaciones</th>

                    <th class="px-2">Renuncia</th>

                    <th class="px-2">Indemnización</th>

                    <th class="px-2">Fecha</th>

                    <th class="px-2">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($calculos as $c)

                <tr class="border-b hover:bg-slate-50 text-center">

                    <td class="px-2 py-3">

                        {{ $c->id }}

                    </td>

                    <td class="px-2 py-3">

                        {{ $c->user->name ?? 'Sin usuario' }}

                    </td>

                    <td class="px-2 py-3">

                        @if($c->tipo_calculo == 'salario')

                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">

                                Salario

                            </span>

                        @else

                            <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs">

                                Prestaciones

                            </span>

                        @endif

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->salario_base ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->afp ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->isss ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->renta ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3 font-semibold text-emerald-600">

                        ${{ number_format($c->salario_neto ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->aguinaldo ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->vacaciones ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->renuncia_voluntaria ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3">

                        ${{ number_format($c->indemnizacion ?? 0,2) }}

                    </td>

                    <td class="px-2 py-3 whitespace-nowrap">

                        {{ $c->created_at->format('d/m/Y') }}

                        <br>

                        {{ $c->created_at->format('H:i') }}

                    </td>

                    <td class="px-2 py-3">

                        <div class="flex flex-col gap-1">

                            <a href="{{ route('historial.edit',$c->id) }}"
                               class="bg-yellow-400 px-2 py-1 rounded text-xs hover:bg-yellow-500">

                                Editar

                            </a>

                            <form action="{{ route('historial.destroy',$c->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('¿Eliminar registro?')"
                                    class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600 w-full">

                                    Eliminar

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="14"
                        class="text-center py-10 text-slate-500">

                        No existen cálculos registrados.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-6">

    <a href="{{ route('dashboard') }}"
       class="bg-slate-900 text-white px-6 py-3 rounded-xl hover:bg-slate-700">

        Volver

    </a>

</div>

</x-app-layout>