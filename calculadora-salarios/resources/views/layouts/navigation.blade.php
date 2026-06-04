<nav class="bg-slate-900 shadow-lg">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            <a href="{{ route('dashboard') }}"
               class="text-xl font-bold text-white">

                Calculadora SV

            </a>

            <div class="flex items-center gap-6">

                <a href="{{ route('dashboard') }}"
                   class="text-slate-200 hover:text-white">

                    Inicio

                </a>

                <span class="text-slate-400">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="bg-red-500 px-4 py-2 rounded-lg text-white hover:bg-red-600">

                        Salir

                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>