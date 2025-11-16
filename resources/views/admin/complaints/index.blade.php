@extends('layouts.app')

@push('page-styles')
  <link rel="stylesheet" href="{{ asset('css/pages/admin.css') }}">
@endpush

@section('content')
  <h1>Klachten</h1>
  <form method="GET" class="filters">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Zoek op ID">
    <select name="status">
      <option value="">Status</option>
      <option value="in_behandeling" @selected(request('status')==='in_behandeling')>In behandeling</option>
      <option value="opgelost" @selected(request('status')==='opgelost')>Opgelost</option>
    </select>
    <select name="category">
      <option value="">Categorie</option>
      @foreach(['afval','verlichting','wegen','groen','overlast'] as $c)
        <option value="{{ $c }}" @selected(request('category')===$c)>{{ ucfirst($c) }}</option>
      @endforeach
    </select>
    <button class="btn btn-primary" type="submit">Filter</button>
  </form>

  <div class="cards-grid">
    @forelse($complaints as $c)
      <div class="card">
        <div class="card-body">
          <div class="card-title">#{{ $c->id }} — {{ $c->title }}</div>
          <div class="card-meta">
            <span class="badge {{ $c->status==='in_behandeling' ? 'is-open':'is-done' }}">{{ $c->status==='in_behandeling'?'In behandeling':'Opgelost' }}</span>
            <small>{{ ucfirst($c->category) }}</small>
          </div>
          <a class="btn btn-secondary" href="{{ route('admin.complaints.show', $c) }}">Bekijken</a>
        </div>
      </div>
    @empty
      <p>Geen klachten gevonden.</p>
    @endforelse
  </div>
  {{ $complaints->links() }}
@endsection

