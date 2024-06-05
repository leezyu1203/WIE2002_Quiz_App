@extends('layouts/layout')

@section('title', 'Login')

@section('content')
<main class="d-flex align-items-center justify-content-center">
    <div class="w-25 py-5">
        <h1 class="mb-4 text-center">Login</h1>
        <form action="{{ route('auth.check') }}" method="post">
        @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif

        @csrf
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-bd-primary w-100">Login</button>
        </form>
        <div class="mt-3">
            <small>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></small>
        </div>
    </div>
</main>
@endsection