@extends('layouts.app')

@push('page-styles')
  <link rel="stylesheet" href="{{ asset('css/pages/complaints.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="{{ asset('css/pages/map.css') }}">
@endpush

@section('content')
  <h1>Nieuwe klacht indienen</h1>
  <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="form">
    @csrf
    <div class="form-group">
      <label for="title">Titel</label>
      <input type="text" id="title" name="title" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
      <label for="description">Beschrijving</label>
      <textarea id="description" name="description" rows="5">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
      <label for="category">Categorie</label>
      <select id="category" name="category" required>
        <option value="">Kies...</option>
        @foreach(['afval'=>'Afval','verlichting'=>'Verlichting','wegen'=>'Wegen','groen'=>'Groen','overlast'=>'Overlast'] as $k=>$v)
          <option value="{{ $k }}" @selected(old('category')===$k)>{{ $v }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group geo-actions">
      <button type="button" id="btn-geolocate" class="btn btn-secondary">Gebruik mijn locatie</button>
    </div>

    <div id="map" class="map"></div>

    <div class="form-row">
      <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" id="lat" name="lat" value="{{ old('lat') }}" required>
      </div>
      <div class="form-group">
        <label for="lng">Longitude</label>
        <input type="text" id="lng" name="lng" value="{{ old('lng') }}" required>
      </div>
    </div>

    <div class="form-group">
      <label for="reporter_name">Uw naam</label>
      <input type="text" id="reporter_name" name="reporter_name" value="{{ old('reporter_name', auth()->user()->name) }}" required>
    </div>

    <div class="form-group">
      <label for="reporter_email">E-mail</label>
      <input type="email" id="reporter_email" name="reporter_email" value="{{ old('reporter_email', auth()->user()->email) }}" required>
    </div>

    <div class="form-group">
      <label for="photos">Foto's (max 3)</label>
      <input type="file" id="photos" name="photos[]" multiple accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Verzenden</button>
  </form>
@endsection

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const defaultCenter = [51.912, 4.341]; // Vlaardingen approx
    const map = L.map('map').setView(defaultCenter, 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);
    let marker = null;
    function setLatLng(lat, lng){
      document.getElementById('lat').value = lat.toFixed(7);
      document.getElementById('lng').value = lng.toFixed(7);
      if (marker) { marker.setLatLng([lat, lng]); } else { marker = L.marker([lat, lng]).addTo(map); }
      map.setView([lat, lng], 16);
    }
    map.on('click', (e)=> setLatLng(e.latlng.lat, e.latlng.lng));
    document.getElementById('btn-geolocate').addEventListener('click', ()=>{
      if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(pos=>{
          setLatLng(pos.coords.latitude, pos.coords.longitude);
        }, ()=>{
          alert('Kon uw locatie niet ophalen. Klik op de kaart.');
        });
      } else {
        alert('Geolocatie niet ondersteund. Klik op de kaart.');
      }
    });
  </script>
@endpush

