@extends('layouts.app')

@section('body-class', 'home-page')

@push('page-styles')
  <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush

@push('scripts')
  <script defer src="{{ asset('js/home.js') }}"></script>
@endpush

@section('content')
  <section class="a11y-bar" aria-label="Toegankelijkheidsinstellingen">
    <div class="container a11y-inner">
      <button type="button" class="a11y-btn" id="btn-readable" aria-pressed="false" aria-label="Verbeter leesbaarheid">
        <span aria-hidden="true">👁️</span> Verbetert leesbaarheid
      </button>
      <button type="button" class="a11y-btn" id="btn-bigtext" aria-pressed="false" aria-label="Maak de tekst groter">
        <span aria-hidden="true">A+</span> Maak de tekst groter
      </button>
      <button type="button" class="a11y-btn" id="btn-contrast" aria-pressed="false" aria-label="Verhoog contrast">
        <span aria-hidden="true">ⓘ</span> Verhoog contrast
      </button>
      <img class="logo" src="{{ asset('images/vlaardingen-lion.svg') }}" alt="Gemeente Vlaardingen logo"/>
    </div>
  </section>

  <section class="hero" aria-label="Panoramafoto van de haven van Vlaardingen">
    <img src="{{ asset('images/hero-vlaardingen.png') }}" alt="Panorama van de haven van Vlaardingen met boten en gevels" />
  </section>

  <nav class="tabs container" aria-label="Hoofdnavigatie tabs">
    <a href="#" class="tab active" aria-current="page">Onderwerpen</a>
    <a href="#" class="tab">Bestuur</a>
    <a href="#" class="tab">Organisatie</a>
    <a href="#" class="tab">Contact</a>
    <form class="search" role="search" aria-label="Zoek op de website" onsubmit="return false;">
      <input type="search" placeholder="Waar bent u naar op zoek?" aria-label="Zoekterm" />
      <button type="submit" class="btn btn-primary">Zoek</button>
    </form>
  </nav>

  <section class="welcome container" aria-labelledby="welcome-title">
    <h1 id="welcome-title" class="welcome-title">Burgemeester Bert Wijbenga heet u alvast van harte welkom.</h1>
    <p class="lead">Wat leuk dat u in Vlaardingen bent komen wonen! Op deze pagina vindt u praktische informatie over Vlaardingen. Uiteraard vindt u op deze website nog veel meer informatie over Vlaardingen. Neem eens een kijkje!</p>

    <div class="video">
      <iframe
        src="https://www.youtube-nocookie.com/embed/9i6oQnK1G8E"
        title="Welkomstvideo nieuwe Vlaardingers"
        width="560" height="315" style="border:0;"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
      </iframe>
    </div>
  </section>

  <button
    class="help-bubble"
    id="helpBubble"
    type="button"
    aria-controls="helpTooltip"
    aria-expanded="false"
    aria-label="Hulp bij lezen"
  >?
  </button>

  <div class="help-tooltip" id="helpTooltip" role="dialog" aria-modal="false" aria-hidden="true" aria-labelledby="helpTitle">
    <div class="help-content">
      <div class="help-header">
        <h2 id="helpTitle">Hulp bij lezen?</h2>
        <button type="button" class="help-close" id="helpClose" aria-label="Sluiten">×</button>
      </div>
      <p>Klik op het vraagteken om deze hulptekst te openen of te sluiten. U kunt ook de ESC‑toets gebruiken om te sluiten.</p>
    </div>
  </div>
@endsection
