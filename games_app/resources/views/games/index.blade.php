@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Games</h1>
        <a href="{{ route('games.create') }}" class="btn btn-primary mb-4">Create Game page</a>
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif


        <form method="GET" action="{{ route('games.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Search by Title" value="{{ request('title') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="genre" class="form-control" placeholder="Search by Genre" value="{{ request('genre') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="platform" class="form-control" placeholder="Search by Platform" value="{{ request('platform') }}">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('games.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>


        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($games as $game)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ !empty($game->cover) ? asset('storage/' . json_decode($game->cover)->path) : asset('path_to_default_image.jpg') }}"
                             alt="Cover" class="card-img-top" style="object-fit: cover; height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->title }}</h5>
                            <p class="card-text">
                                <strong>Developer:</strong> {{ $game->developer }}<br>
                                <strong>Genre:</strong> {{ $game->genre }}<br>
                                <strong>Release Date:</strong> {{ $game->release_date }}<br>
                                <strong>Platform:</strong> {{ $game->platform }}<br>
                                <strong>Price:</strong> ${{ $game->price }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('games.show', $game) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('games.edit', $game) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4 mb-4">
            {{ $games->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
