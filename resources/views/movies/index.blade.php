@extends('layouts.app')

@section('judul', 'Manage Movie | Top Movie')

@section('content')
    {{-- ADD MODAL --}}
    @include('movies.create', $genres)

    {{-- MANAGE GENRES --}}
    <div class="container mt-5">
        <div class="col-md-9 bg-light p-4 rounded">
            {{-- HEADING --}}
            <h4>Manage Movie</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore ipsam quod fuga eos cupiditate amet quam</p>
            <hr>

            @if (Auth::user()->role == 'Member')
                <button class="btn btn-sm btn-dark my-2" data-bs-toggle="modal" data-bs-target="#createMovieModal">
                    <i class="uil uil-plus-circle me-1"></i>
                    Buat Movie
                </button>
            @endif

            {{-- MESSAGE --}}
            @if (session('success_msg'))
                <div class="alert alert-success">{{ session('success_msg') }}</div>
            @endif

            {{-- TABLE --}}
            @if ($movies->count() != 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Judul Film</th>
                            <th>Deskripsi Film</th>
                            <th>Tahun Rilis</th>
                            <th>Penulis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/movies/' . $movie->thumbnail) }}" width="100">
                                </td>
                                <td>
                                    <span class="d-block">{{ $movie->title }}</span>
                                    <span class="badge bg-primary">{{ $movie->genre->title }}</span>
                                </td>
                                <td>{{ $movie->description }}</td>
                                <td>{{ $movie->tahun_rilis }}</td>
                                <td>{{ $movie->user->name }}</td>
                                <td>
                                    @if (Auth::user()->role == 'Member')
                                        <a href="{{ route('editMovie', $movie->id) }}" class="text-primary"><i
                                                class="uil uil-edit"></i></a>
                                    @endif
                                    <a href="#" class="text-danger"
                                        onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                                        <i class="uil uil-trash-alt"></i>
                                        <form id="delete-form" action="{{ route('deleteMovie', $movie->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">
                    Masih belum ada movie nih
                </div>
            @endif
        </div>
    </div>
@endsection
