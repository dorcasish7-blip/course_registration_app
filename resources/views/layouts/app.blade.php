<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Course Registration')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gradient-page text-slate-900 min-h-screen">
    <div class="mx-auto max-w-6xl px-4 py-6">
        {{-- Gradient Header Bar --}}
        <header class="mb-6 rounded-2xl bg-gradient-to-r from-brand-700 via-brand-600 to-secondary-700 p-5 shadow-lg">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-tight text-white">📚 University Registration</a>
                    <p class="text-sm text-white/70">Manage students, courses, enrollments, and reports.</p>
                </div>
                @auth
                    <nav class="flex flex-wrap gap-2">
                        <a href="{{ route('dashboard') }}" class="nav-link-active">Dashboard</a>
                        <a href="{{ route('students.index') }}" class="nav-link-inactive">Students</a>
                        <a href="{{ route('courses.index') }}" class="nav-link-inactive">Courses</a>
                        <a href="{{ route('enrollment.create') }}" class="nav-link-inactive">Enroll</a>
                        <a href="{{ route('reports.index') }}" class="nav-link-inactive">Reports</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-white/20 hover:bg-white/30 text-white text-xs font-medium rounded-lg px-3 py-1.5 transition-all duration-150">Logout</button>
                        </form>
                    </nav>
                @endauth
            </div>
        </header>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Content --}}
        <main class="animate-fade-in">
            @yield('content')
        </main>
    </div>
</body>
</html>
