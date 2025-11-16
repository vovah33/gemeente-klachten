@extends('layouts.app')

@section('content')
  <h1>Bevestig wachtwoord</h1>
  <p>Bevestig uw wachtwoord om door te gaan.</p>
  <form method="POST" action="{{ route('password.confirm') }}" class="form" style="max-width:480px;">
    @csrf
    <div class="form-group">
      <label for="password">Wachtwoord</label>
      <input id="password" type="password" name="password" required autocomplete="current-password">
    </div>
    <button class="btn btn-primary" type="submit">Bevestigen</button>
  </form>
@endsection
