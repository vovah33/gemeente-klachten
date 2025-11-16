<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Klacht Gemeente') }}</title>

    <link rel="stylesheet" href="{{ asset('css/base/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/badges.css') }}">
    @stack('page-styles')
</head>
<body class="@yield('body-class')">
    <a href="#main-content" class="skip-link">Skip to content</a>
    <header class="navbar">
        <div class="container nav-inner">
            <a href="{{ url('/') }}" class="brand">Gemeente Vlaardingen</a>
            <nav class="nav-links">
                @guest
                    <a href="{{ route('login') }}">Inloggen</a>
                    <a href="{{ route('register') }}">Registreren</a>
                @else
                    <a href="{{ route('complaints.create') }}">Dien klacht in</a>
                    <a href="{{ route('complaints.mine') }}">Mijn klachten</a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.complaints.index') }}">Klachten</a>
                        <a href="{{ route('admin.map.index') }}">Kaart</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button class="btn btn-secondary" type="submit">Uitloggen</button>
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <main id="main-content" class="main container" tabindex="-1">
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert error">
                <strong>Fout:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
