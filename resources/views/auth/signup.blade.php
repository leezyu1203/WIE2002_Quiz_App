@extends('layouts/layout')

@section('title', 'Sign Up')

@section('content')
<main class="d-flex align-items-center justify-content-center">
    <div class="w-25">
        <h1 class="mb-3 text-center">Sign Up</h1>
        <form action="{{ route('auth.register') }}" method="post">
        @if (Session::get('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
        @endif
        
        @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif

        @csrf
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-bd-primary w-100">Sign Up</button>
        </form>
        <div class="mt-3">
            <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
        </div>
    </div>
</main>
@endsection