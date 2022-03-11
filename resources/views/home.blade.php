@extends('layouts.app')

@section('judul', 'Dashboard | Top Movie')

@section('content')
    <h1 class="text-white">Haloo {{ Auth::user()->name }}</h1>
    <h2 class="text-white">Kamu adalah {{ Auth::user()->role }}</h2>
@endsection
