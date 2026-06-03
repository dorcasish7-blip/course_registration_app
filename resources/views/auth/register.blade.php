@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="mx-auto max-w-md mt-8">
    <div class="auth-card text-center">
        <div class="mb-2">📝</div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Create an account</h1>
        <p class="mt-1 text-sm text-slate-500">Get started with your account</p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5 text-left">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-input" placeholder="Choose a username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Create a password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Repeat your password" required>
            </div>

            <button type="submit" class="btn-primary w-full">Register</button>
        </form>
    </div>

    <p class="mt-6 text-center text-sm text-slate-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-brand-600 hover:text-brand-700">Sign in</a>
    </p>
</div>
@endsection
