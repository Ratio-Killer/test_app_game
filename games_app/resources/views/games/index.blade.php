@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Games</h1>
        <a href="{{ route('games.create') }}" class="btn btn-primary">Create Game page</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Developer</th>
                <th>Genre</th>
                <th>Release date</th>
                <th>Platform</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->developer }}</td>
                    <td>{{ $game->genre }}</td>
                    <td>{{ $game->release_date }}</td>
                    <td>{{ $game->platform }}</td>
                    <td>{{ $game->price }}</td>

                    <td>
                        <a href="{{ route('games.show', $game) }}" class="btn btn-info">View</a>
                        <a href="{{ route('games.edit', $game) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
