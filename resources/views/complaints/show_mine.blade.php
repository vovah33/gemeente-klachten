@extends('layouts.app')

@push('page-styles')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="{{ asset('css/pages/map.css') }}">
@endpush

@section('content')
  <h1>Klacht #{{ $complaint->id }}</h1>
  <p><strong>Titel:</strong> {{ $complaint->title }}</p>
  <p><strong>Categorie:</strong> {{ ucfirst($complaint->category) }}</p>
  <p><strong>Status:</strong>
    @if($complaint->status==='in_behandeling')
      <span class="badge is-open">In behandeling</span>
    @else
      <span class="badge is-done">Opgelost</span>
    @endif
  </p>
  <p><strong>Beschrijving:</strong><br>{{ $complaint->description }}</p>

  <div id="mini-map" class="map small"></div>

  @if($complaint->photos->count())
    <h3>Foto's</h3>
    <div class="gallery">
      @foreach($complaint->photos as $p)
        <a href="{{ asset('storage/'.$p->path) }}" target="_blank">
          <img src="{{ asset('storage/'.$p->path) }}" alt="Foto {{ $loop->iteration }}" />
        </a>
      @endforeach
    </div>
  @endif

  <a href="{{ route('complaints.mine') }}" class="btn btn-secondary">Terug</a>
@endsection

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const map = L.map('mini-map').setView([{{ (float)$complaint->lat }}, {{ (float)$complaint->lng }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    L.marker([{{ (float)$complaint->lat }}, {{ (float)$complaint->lng }}]).addTo(map);
  </script>
@endpush

