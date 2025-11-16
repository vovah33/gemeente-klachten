<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('css/base/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/base/variables.css') }}">
        <link rel="stylesheet" href="{{ asset('css/layout/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/forms.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/cards.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/badges.css') }}">
    </head>
    <body>
        <main class="main container">
            {{ $slot }}
        </main>
    </body>
</html>
