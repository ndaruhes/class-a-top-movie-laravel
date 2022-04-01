@extends('layouts.app')

@section('judul', 'Edit Movie | Top Movie')

@section('content')
    {{-- MANAGE GENRES --}}
    <div class="container mt-5">
        <div class="col-md-9 bg-light p-4 rounded">
            {{-- HEADING --}}
            <h4>Edit Movie</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore ipsam quod fuga eos cupiditate amet quam</p>
            <hr>

            {{-- EDIT FORM --}}
            <form action="{{ route('updateMovie', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Thumbnail Film</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                        value="{{ old('thumbnail') ? old('thumbnail') : $movie->thumbnail }}">
                    @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Judul Film</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Judul Film..."
                        name="title" value="{{ old('title') ? old('title') : $movie->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi Film</label>
                    <textarea rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi Film..."
                        name="description">
                        {{ old('description') ? old('description') : $movie->description }}
                    </textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tahun Rilis</label>
                    <input type="number" class="form-control @error('tahun_rilis') is-invalid @enderror"
                        placeholder="Tahun Rilis..." name="tahun_rilis" value="{{ old('tahun_rilis') ? old('tahun_rilis') : $movie->tahun_rilis }}">
                    @error('tahun_rilis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <select class="form-control @error('genre') is-invalid @enderror" name="genre">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                        @endforeach
                    </select>
                    @error('genre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
