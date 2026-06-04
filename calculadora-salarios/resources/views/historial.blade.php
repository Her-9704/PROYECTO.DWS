<x-app-layout>

<x-slot name="header">
    Historial de Cálculos
</x-slot>

<div class="overflow-x-auto">

<table class="w-full bg-white rounded-2xl overflow-hidden shadow">

<thead class="bg-slate-800 text-white">

<tr>
<th class="p-4">ID</th>
<th>Tipo</th>
<th>Base</th>
<th>AFP</th>
<th>ISSS</th>
<th>Renta</th>
<th>Neto</th>
<th>Fecha</th>
<th>Acciones</th>
</tr>

</thead>

<tbody>

@foreach($calculos as $c)

<tr class="border-b hover:bg-slate-50">

<td class="p-4">{{ $c->id }}</td>

<td>{{ $c->tipo_calculo }}</td>

<td>${{ $c->salario_base }}</td>

<td>${{ $c->afp }}</td>

<td>${{ $c->isss }}</td>

<td>${{ $c->renta }}</td>

<td class="font-semibold text-emerald-600">
${{ $c->salario_neto }}
</td>

<td>{{ $c->created_at }}</td>

<td class="flex gap-2 py-3">

<a href="{{ route('historial.edit',$c->id) }}"
class="bg-yellow-400 px-3 py-1 rounded-lg">

Editar

</a>

<form action="{{ route('historial.destroy',$c->id) }}"
method="POST">

@csrf
@method('DELETE')

<button class="bg-red-500 text-white px-3 py-1 rounded-lg">

Eliminar

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-6">

<a href="/"
class="bg-slate-800 text-white px-5 py-3 rounded-xl">

Volver

</a>

</div>

</x-app-layout>