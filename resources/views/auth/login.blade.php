@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="mx-auto max-w-md mt-8">
    <div class="auth-card text-center">
        <div class="mb-2">🔐</div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Welcome back</h1>
        <p class="mt-1 text-sm text-slate-500">Sign in to your account</p>

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5 text-left">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-input" placeholder="Enter your username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-primary w-full">Sign in</button>
        </form>
    </div>

    <p class="mt-6 text-center text-sm text-slate-600">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-semibold text-brand-600 hover:text-brand-700">Create one</a>
    </p>
</div>
@endsection
