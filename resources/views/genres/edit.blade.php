@extends('layouts.app')

@section('judul', 'Edit Genre | Top Movie')


@section('content')
    <div class="container mt-5">
        <div class="col-md-7 bg-light p-4 rounded">
            {{-- HEADING --}}
            <h4>Edit Genre</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore ipsam quod fuga eos cupiditate amet quam</p>
            <hr>

            {{-- FORM EDIT --}}
            <form action="{{ route('updateGenre', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Genre</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Typed genre title..." name="title"
                        value="{{ old('title') ? old('title') : $genre->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
