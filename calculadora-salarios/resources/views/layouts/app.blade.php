<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>

        {{ config('app.name', 'Calculadora Salarios') }}

    </title>

    <link rel="preconnect"
          href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans bg-gradient-to-br from-slate-100 to-blue-100 min-h-screen">

    @include('layouts.navigation')

    @isset($header)

        <section class="w-full px-8 pt-8">

            <h1 class="text-3xl font-bold text-slate-800">

                {{ $header }}

            </h1>

        </section>

    @endisset

    <main class="w-full px-8 py-8">

        <div class="bg-white rounded-3xl shadow-xl p-8 w-full">

            {{ $slot }}

        </div>

    </main>

</body>

</html>