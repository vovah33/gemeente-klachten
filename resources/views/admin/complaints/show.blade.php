@extends('layouts.app')

@push('page-styles')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="{{ asset('css/pages/map.css') }}">
@endpush

@section('content')
  <h1>Klacht #{{ $complaint->id }}</h1>
  <div class="card">
    <div class="card-body">
      <div class="card-title">{{ $complaint->title }}</div>
      <p><strong>Categorie:</strong> {{ ucfirst($complaint->category) }}</p>
      <p><strong>Status:</strong>
        @if($complaint->status==='in_behandeling')
          <span class="badge is-open">In behandeling</span>
        @else
          <span class="badge is-done">Opgelost</span>
        @endif
      </p>
      <p>{{ $complaint->description }}</p>
      <div id="mini-map" class="map small"></div>
      <p><strong>Melder:</strong> {{ $complaint->reporter_name }} ({{ $complaint->reporter_email }})</p>
      <p><strong>Gerapporteerd:</strong> {{ $complaint->created_at->format('d-m-Y H:i') }}</p>
    </div>
  </div>

  @if($complaint->photos->count())
    <h3>Foto's</h3>
    <div class="gallery">
      @foreach($complaint->photos as $p)
        <a href="{{ asset('storage/'.$p->path) }}" target="_blank"><img src="{{ asset('storage/'.$p->path) }}" alt="foto"></a>
      @endforeach
    </div>
  @endif

  <h3>Notities</h3>
  <ul>
    @forelse($complaint->notes as $n)
      <li><small>{{ $n->created_at->format('d-m-Y H:i') }}</small> — {{ $n->content }}</li>
    @empty
      <li>Geen notities.</li>
    @endforelse
  </ul>

  @if($complaint->status==='in_behandeling')
  <form action="{{ route('admin.complaints.resolve', $complaint) }}" method="POST" style="margin-top:1rem;">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <label for="note">Notitie (optioneel)</label>
      <textarea id="note" name="note" rows="3"></textarea>
    </div>
    <button class="btn btn-success" type="submit">Markeer als opgelost</button>
  </form>
  @endif

  <form action="{{ route('admin.complaints.destroy', $complaint) }}" method="POST" onsubmit="return confirm('Verwijderen?');" style="margin-top:1rem;">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" type="submit">Verwijderen</button>
    <a href="{{ route('admin.complaints.index') }}" class="btn btn-secondary">Terug</a>
  </form>
@endsection

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const map = L.map('mini-map').setView([{{ (float)$complaint->lat }}, {{ (float)$complaint->lng }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    L.marker([{{ (float)$complaint->lat }}, {{ (float)$complaint->lng }}]).addTo(map);
  </script>
@endpush

