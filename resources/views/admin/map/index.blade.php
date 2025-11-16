@extends('layouts.app')

@push('page-styles')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="{{ asset('css/pages/map.css') }}">
@endpush

@section('content')
  <h1>Kaart — Klachten</h1>
  <div id="map" class="map full"></div>
@endsection

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([51.912, 4.341], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    fetch("{{ route('admin.api.complaints') }}").then(r=>r.json()).then(items => {
      items.forEach(i => {
        const m = L.marker([i.lat, i.lng]).addTo(map);
        const status = i.status === 'in_behandeling' ? 'In behandeling' : 'Opgelost';
        m.bindPopup(`<strong>#${i.id} ${i.title}</strong><br>${status}<br><a href='${i.url}'>Open</a>`);
      });
    });
  </script>
@endpush

