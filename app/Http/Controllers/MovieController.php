<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        $movies = Movie::all();
        $genres = Genre::all();
        return view('movies.index', [
            'movies' => $movies,
            'genres' => $genres
        ]);
    }
    public function store(){}
    public function edit(){}
    public function update(){}
    public function destroy(){}
}
