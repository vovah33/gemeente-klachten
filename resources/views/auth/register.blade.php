@extends('layouts.app')

@section('content')
  <h1>Registreren</h1>
  <form method="POST" action="{{ route('register') }}" class="form" style="max-width:480px;">
    @csrf
    <div class="form-group">
      <label for="name">Naam</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>
    <div class="form-group">
      <label for="email">E-mail</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
      <label for="password">Wachtwoord</label>
      <input id="password" type="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="password_confirmation">Bevestig wachtwoord</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>
    <div class="form-actions">
      <button class="btn btn-primary" type="submit">Registreren</button>
      <a href="{{ route('login') }}" class="btn btn-secondary">Al geregistreerd?</a>
    </div>
  </form>
@endsection
