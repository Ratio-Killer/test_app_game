@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $game->title }}</h1>
        <p><strong>Developer:</strong> {{ $game->developer }}</p>
        <p><strong>Genre:</strong> {{ $game->genre }}</p>
        <p><strong>Release date:</strong> {{ $game->release_date }}</p>
        <p><strong>Platform:</strong> {{ $game->platform }}</p>
        <p><strong>Price:</strong> ${{ number_format($game->price, 2) }}</p>

        @if (!empty($game->cover))
            <img src="{{ asset('storage/' . json_decode($game->cover)->path) }}" alt="Обложка" width="200">
        @endif


        <a href="{{ route('games.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
