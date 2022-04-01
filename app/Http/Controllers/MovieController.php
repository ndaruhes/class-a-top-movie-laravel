<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        // if (Auth::user()->role == 'Member') {
        //     $movies = Movie::where('user_id', Auth::user()->id)->get();
        // } else {
        //     $movies = Movie::all();
        // }

        $movies = Auth::user()->role == 'Member' ? Movie::where('user_id', Auth::user()->id)->get() : Movie::all();

        $genres = Genre::all();
        return view('movies.index', [
            'movies' => $movies,
            'genres' => $genres
        ]);
    }
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'thumbnail' => 'required',
            'title' => 'required|min:3',
            'description' => 'required|min:5|max:100',
            'tahun_rilis' => 'required|numeric',
            'genre' => 'required'
        ]);

        // File Processing
        $files = $request->file('thumbnail');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $thumbnail = $fileName . '-' . Str::random(10) . '-' . date('dmYhis') . '.' . $extension;
        $files->storeAs('public/movies/', $thumbnail);

        // Insert Movie to Database
        Movie::create([
            'thumbnail' => $thumbnail,
            'title' => $request->title,
            'description' => $request->description,
            'tahun_rilis' => $request->tahun_rilis,
            'genre_id' => $request->genre,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/movie')->with('success_msg', 'Movie berhasil ditambah');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        if ($movie->user_id != Auth::user()->id) {
            return abort(404);
        }
        return view('movies.edit', [
            'movie' => $movie,
            'genres' => $genres
        ]);
    }

    public function update(Request $request, $id)
    {
        // Kalo dia gk update gambar
        if ($request->file('thumbnail') == null) {
            $request->validate([
                'title' => 'required|min:3',
                'description' => 'required|min:5|max:100',
                'tahun_rilis' => 'required|numeric',
                'genre' => 'required'
            ]);

            $movie = Movie::findOrFail($id);
            if ($movie->user_id != Auth::user()->id) {
                return abort(404);
            }
            $movie->update([
                'title' => $request->title,
                'description' => $request->description,
                'tahun_rilis' => $request->tahun_rilis,
                'genre_id' => $request->genre,
                'user_id' => Auth::user()->id

                
            ]);

            return redirect('/movie')->with('success_msg', 'Movie berhasil diubah');
        } else {
            // Validasi
            $request->validate([
                'thumbnail' => 'required',
                'title' => 'required|min:3',
                'description' => 'required|min:5|max:100',
                'tahun_rilis' => 'required|numeric',
                'genre' => 'required'
            ]);

            // File Processing
            $files = $request->file('thumbnail');
            $fullFileName = $files->getClientOriginalName();
            $fileName = pathinfo($fullFileName)['filename'];
            $extension = $files->getClientOriginalExtension();
            $thumbnail = $fileName . '-' . Str::random(10) . '-' . date('dmYhis') . '.' . $extension;
            $files->storeAs('public/movies/', $thumbnail);

            // Update Movie to Database
            $movie = Movie::findOrFail($id);
            if ($movie->user_id != Auth::user()->id) {
                return abort(404);
            }
            if (Storage::exists('public/movies/' . $movie->thumbnail)) {
                Storage::delete('public/movies/' . $movie->thumbnail);
            }
            $movie->update([
                'thumbnail' => $thumbnail,
                'title' => $request->title,
                'description' => $request->description,
                'tahun_rilis' => $request->tahun_rilis,
                'genre_id' => $request->genre,
                'user_id' => Auth::user()->id
            ]);

            return redirect('/movie')->with('success_msg', 'Movie berhasil diubah');
        }
    }
    
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->user_id != Auth::user()->id) return abort(404);
        if (Storage::exists('public/movies/' . $movie->thumbnail)) {
            Storage::delete('public/movies/' . $movie->thumbnail);
        }
        $movie->delete();
        return redirect('/movie')->with('success_msg', 'Movie berhasil dihapus');
    }
}
