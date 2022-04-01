@extends('layouts.app')

@section('judul', 'Explore Movie | TopMovie')

@section('content')
    <div class="container movie-wrapper">
        <h3>All Movies</h3>
        <hr>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-3 movie-item">
                    <div class="col-md-12 movie-content">
                        <img src="{{ asset('storage/movies/' . $movie->thumbnail) }}" class="w-100">
                        <h1>{{ $movie->title }}</h1>
                        <p>{{ $movie->description }}</p>
                        <span class="text-muted">{{ $movie->user->name }}</span>
                        <span class="badge bg-warning">{{ $movie->genre->title }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
