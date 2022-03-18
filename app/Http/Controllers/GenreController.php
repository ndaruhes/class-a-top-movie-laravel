<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', [
            'genres' => $genres
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // Masukkan data ke database
        Genre::create([
            'title' => $request->title,
        ]);

        // Redirect ke halaman manage genre
        return redirect('/genre')->with('success_msg', 'Genre berhasil ditambahkan');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', [
            'genre' => $genre
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // Update data didatabase
        $genre = Genre::findOrFail($id);
        $genre->update([
            'title' => $request->title
        ]);

        // Redirect ke halaman manage genre
        return redirect('/genre')->with('success_msg', 'Genre berhasil diubah');
    }

    public function destroy($id)
    {
        // Menghapus data di tabel dalam database
        $genre = Genre::findOrFail($id);
        $genre->delete();

        // Redirect ke halaman manage genre
        return redirect('/genre')->with('success_msg', 'Genre berhasil dihapus');
    }
}
