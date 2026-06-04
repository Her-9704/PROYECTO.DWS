<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full bg-slate-800 border-slate-700 text-white placeholder-gray-400 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-2">

    <a href="{{ route('password.request') }}"
       class="text-sm text-gray-700 hover:text-black underline">

        ¿Olvidaste tu contraseña?

    </a>
</div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 mt-6">

    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl">

        Iniciar Sesión

    </button>

    <a href="{{ route('register') }}"
       class="text-center border border-gray-300 rounded-xl py-3 hover:bg-gray-100">

        Crear una cuenta

    </a>

</div>
    </form>
</x-guest-layout>
