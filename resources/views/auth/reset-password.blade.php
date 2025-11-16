@extends('layouts.app')

@section('content')
  <h1>Wachtwoord resetten</h1>
  <form method="POST" action="{{ route('password.store') }}" class="form" style="max-width:520px;">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="form-group">
      <label for="email">E-mail</label>
      <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
    </div>
    <div class="form-group">
      <label for="password">Nieuw wachtwoord</label>
      <input id="password" type="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="password_confirmation">Bevestig wachtwoord</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>
    <button class="btn btn-primary" type="submit">Resetten</button>
  </form>
@endsection
