<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getAllMovies($view)
    {
        $movies = Movie::where('status', 'Accepted')->get();
        return view($view, [
            'movies' => $movies
        ]);
    }
    public function index()
    {
        return $this->getAllMovies('index');
    }

    public function explore()
    {
        return $this->getAllMovies('explore');
    }
}
