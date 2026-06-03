@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="card max-w-2xl">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900">✏️ Edit Student</h1>
    <form action="{{ route('students.update', $student) }}" method="POST" class="mt-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" class="form-input" placeholder="Enter student name" required>
        </div>
        <div class="form-group">
            <label for="program" class="form-label">Program</label>
            <input type="text" id="program" name="program" value="{{ old('program', $student->program) }}" class="form-input" placeholder="e.g. Computer Science" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">💾 Update</button>
            <a href="{{ route('students.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
