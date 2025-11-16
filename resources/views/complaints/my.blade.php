@extends('layouts.app')

@section('content')
  <h1>Mijn klachten</h1>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titel</th>
          <th>Categorie</th>
          <th>Status</th>
          <th>Aangemaakt</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($complaints as $c)
          <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->title }}</td>
            <td>{{ ucfirst($c->category) }}</td>
            <td>
              @if($c->status==='in_behandeling')
                <span class="badge is-open">In behandeling</span>
              @else
                <span class="badge is-done">Opgelost</span>
              @endif
            </td>
            <td>{{ $c->created_at->format('d-m-Y') }}</td>
            <td><a class="btn btn-secondary" href="{{ route('complaints.show.mine', $c) }}">Details</a></td>
          </tr>
        @empty
          <tr><td colspan="6">Nog geen klachten.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $complaints->links() }}
@endsection

