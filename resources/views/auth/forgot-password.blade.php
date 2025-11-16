@extends('layouts.app')

@section('content')
  <h1>Wachtwoord vergeten</h1>
  <p>Vul uw e-mailadres in; we sturen een link om uw wachtwoord te resetten.</p>
  @if (session('status'))
    <div class="alert success">{{ session('status') }}</div>
  @endif
  <form method="POST" action="{{ route('password.email') }}" class="form" style="max-width:480px;">
    @csrf
    <div class="form-group">
      <label for="email">E-mail</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
    <button class="btn btn-primary" type="submit">Verstuur reset-link</button>
  </form>
@endsection
