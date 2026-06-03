@extends('layouts.app')

@section('title', 'Course Enrollment')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
    <div class="card">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">📋 Enroll Student</h1>
        <form action="{{ route('enrollment.store') }}" method="POST" class="mt-6 space-y-5">
            @csrf
            <div class="form-group">
                <label for="student_id" class="form-label">Student</label>
                <select name="student_id" id="student_id" class="form-select" required>
                    <option value="">Select a student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->student_id }}" {{ old('student_id') == $student->student_id ? 'selected' : '' }}>{{ $student->name }} — {{ $student->program }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="course_id" class="form-label">Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    <option value="">Select a course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->course_id }}" {{ old('course_id') == $course->course_id ? 'selected' : '' }}>{{ $course->course_name }} ({{ $course->credits }} credits)</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-primary w-full">✅ Enroll</button>
        </form>
    </div>

    <div class="card">
        <h2 class="text-xl font-semibold text-slate-900">🕐 Recent Enrollments</h2>
        <div class="mt-4 space-y-3">
            @forelse($registrations as $registration)
                <div class="rounded-lg border border-slate-200 bg-gradient-to-r from-slate-50 to-white p-4 transition-all duration-150 hover:border-brand-200 hover:shadow-sm hover:from-brand-50/50">
                    <div class="text-xs font-medium uppercase tracking-wide text-slate-500">{{ $registration->created_at->format('M d, Y H:i') }}</div>
                    <div class="mt-1 font-semibold text-slate-900">{{ $registration->student->name }}</div>
                    <div class="text-sm text-slate-600">{{ $registration->course->course_name }} — <span class="badge-blue">{{ $registration->course->credits }} credits</span></div>
                </div>
            @empty
                <div class="empty-state">
                    <span class="empty-state-icon">📋</span>
                    <p class="empty-state-text">No enrollments yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
