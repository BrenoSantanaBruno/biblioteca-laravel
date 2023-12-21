<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-200 to-blue-300 min-h-screen flex items-center justify-center">
<div class="container mx-auto p-4 text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">Bem-vindo ao Laravel</h1>

    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-100">Registrar</a>
                @endif
            @endauth
        @endif

        <!-- Botão para Autenticação OAuth2 -->
        <a href="{{ route('oauth.login') }}" class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-500 hover:bg-green-600">Login com OAuth2</a>
    </div>
</div>
</body>
</html>
