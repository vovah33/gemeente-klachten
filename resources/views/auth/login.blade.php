@extends('layouts.app')

@section('content')
  <h1>Inloggen</h1>
  @if (session('status'))
    <div class="alert success">{{ session('status') }}</div>
  @endif
  <form method="POST" action="{{ route('login') }}" class="form" style="max-width:480px;">
    @csrf
    <div class="form-group">
      <label for="email">E-mail</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
    </div>
    <div class="form-group">
      <label for="password">Wachtwoord</label>
      <input id="password" type="password" name="password" required autocomplete="current-password">
    </div>
    <div class="form-group">
      <label><input type="checkbox" name="remember"> Onthoud mij</label>
    </div>
    <div class="form-actions">
      <button class="btn btn-primary" type="submit">Log in</button>
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="btn btn-secondary">Wachtwoord vergeten?</a>
      @endif
    </div>
  </form>
@endsection
