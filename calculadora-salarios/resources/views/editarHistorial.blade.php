<x-app-layout>

<x-slot name="header">
    Editar Registro
</x-slot>

<div class="max-w-xl">

<form method="POST"
action="{{ route('historial.update',$calculo->id) }}"
class="bg-white p-8 rounded-2xl shadow space-y-6">

@csrf
@method('PUT')

<div>

<label class="block mb-2 font-medium">

Salario Base

</label>

<input
type="number"
step="0.01"
name="salario_base"
value="{{ $calculo->salario_base }}"
required

class="w-full border rounded-xl p-3">

</div>

<div class="flex gap-3">

<button class="bg-blue-600 text-white px-6 py-3 rounded-xl">

Actualizar

</button>

<a href="{{ route('historial') }}"
class="bg-gray-300 px-6 py-3 rounded-xl">

Cancelar

</a>

</div>

</form>

</div>

</x-app-layout>