@extends('layouts.app')

@section('judul', 'Register | Top Movie')

@section('content')
    <div class="container mt-5">
        <div class="col-md-4 bg-white p-3 rounded">
            <h6>Register</h6>
            <hr>
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>
                        Email
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="Your email">
                </div>
                <div class="form-group">
                    <label>
                        Name
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="text" name="name" class="form-control" placeholder="Your name">
                </div>
                <div class="form-group">
                    <label>
                        Password
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Your password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm password">
                </div>

                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
    </div>
@endsection
