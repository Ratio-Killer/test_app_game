@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit game: {{ $game->title }}</h1>

        <form action="{{ route('games.update', $game) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $game->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Developer</label>
                <input type="text" name="developer" class="form-control" value="{{ $game->developer }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name="genre" class="form-control" value="{{ $game->genre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Release date</label>
                <input type="date" name="release_date" class="form-control" value="{{ $game->release_date }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Platform</label>
                <input type="text" name="platform" class="form-control" value="{{ $game->platform }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" step="0.01" class="form-control" value="{{ $game->price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cover (Image)</label>
                @if(!empty($game->cover))
                    <img src="{{ asset('storage/' . $game->cover) }}" alt="Cover {{ $game->title }}" class="img-fluid d-block mb-2" style="max-width: 200px;">
                @endif
                <input type="file" name="cover" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('games.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
