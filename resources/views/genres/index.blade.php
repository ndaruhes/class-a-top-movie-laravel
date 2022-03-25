@extends('layouts.app')

@section('judul', 'Manage Genre | Top Movie')

@section('content')
    {{-- ADD MODAL --}}
    @include('genres.create')

    {{-- MANAGE GENRES --}}
    <div class="container mt-5">
        <div class="col-md-7 bg-light p-4 rounded">
            {{-- HEADING --}}
            <h4>Manage Genres</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore ipsam quod fuga eos cupiditate amet quam</p>
            <hr>
            <button class="btn btn-sm btn-dark my-2" data-bs-toggle="modal" data-bs-target="#createGenreModal">
                <i class="uil uil-plus-circle me-1"></i>
                    Buat Genre
            </button>

            {{-- MESSAGE --}}
            @if (session('success_msg'))
                <div class="alert alert-success">{{ session('success_msg') }}</div>
            @endif

            {{-- TABLE --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Genre</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $genre->title }}</td>
                            <td>
                                <a href="{{ route('editGenre', $genre->id) }}" class="text-primary"><i
                                        class="uil uil-edit"></i></a>
                                <a href="#" class="text-danger"
                                    onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                                    <i class="uil uil-trash-alt"></i>
                                    <form id="delete-form" action="{{ route('deleteGenre', $genre->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
