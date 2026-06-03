@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="card max-w-2xl">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900">✏️ Edit Course</h1>
    <form action="{{ route('courses.update', $course) }}" method="POST" class="mt-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="course_name" class="form-label">Course name</label>
            <input type="text" id="course_name" name="course_name" value="{{ old('course_name', $course->course_name) }}" class="form-input" placeholder="e.g. Introduction to Programming" required>
        </div>
        <div class="form-group">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" id="credits" name="credits" value="{{ old('credits', $course->credits) }}" min="1" max="20" class="form-input w-32" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">💾 Update</button>
            <a href="{{ route('courses.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
