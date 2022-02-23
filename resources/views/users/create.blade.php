@extends('layouts.app')
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Add new user</h1>
    <div class="lead">
        Add new user and assign role.
    </div>

    <div class="container mt-4">
        <form method="POST" action="">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Full name">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-user"></span></div>
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" placeholder="Username">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-user"></span></div>
                </div>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save user</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>

@endsection
