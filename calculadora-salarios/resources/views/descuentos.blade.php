<x-app-layout>

<div class="max-w-3xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6">

        Editar descuentos de ley

    </h2>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    <form method="POST"
          action="{{ route('descuentos.update') }}">

        @csrf

        <div class="mb-4">

            <label class="block mb-2 font-semibold">

                Descuento ISSS

            </label>

            <input
                type="number"
                step="0.0001"
                name="isss"
                value="{{ $descuento->isss }}"
                class="w-full border rounded p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-semibold">

                Descuento AFP

            </label>

            <input
                type="number"
                step="0.0001"
                name="afp"
                value="{{ $descuento->afp }}"
                class="w-full border rounded p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-semibold">

                Techo AFP

            </label>

            <input
                type="number"
                step="0.01"
                name="techo_afp"
                value="{{ $descuento->techo_afp }}"
                class="w-full border rounded p-2">

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-semibold">

                Techo ISSS

            </label>

            <input
                type="number"
                step="0.01"
                name="techo_isss"
                value="{{ $descuento->techo_isss }}"
                class="w-full border rounded p-2">

        </div>

        <button
            class="bg-blue-600 text-white px-5 py-2 rounded">

            Guardar cambios

        </button>

    </form>

</div>

</x-app-layout>