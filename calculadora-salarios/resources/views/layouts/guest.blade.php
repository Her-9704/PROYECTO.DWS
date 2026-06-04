<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Calculadora Salarios') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">

        <div class="text-center mb-6">

            <h1 class="text-4xl font-bold text-white">
                Calculadora Salarios
            </h1>

            <p class="text-slate-300 mt-2">
                Inicia sesión para continuar
            </p>

        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-8">

            {{ $slot }}

        </div>

    </div>

</body>
</html>