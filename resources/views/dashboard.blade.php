@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid gap-6 md:grid-cols-3">
    <div class="stat-card">
        <span class="stat-label">Students</span>
        <span class="stat-value text-brand-600">{{ $studentCount }}</span>
        <span class="stat-description">Total registered students.</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Courses</span>
        <span class="stat-value text-secondary-600">{{ $courseCount }}</span>
        <span class="stat-description">Courses available for enrollment.</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Enrollments</span>
        <span class="stat-value text-emerald-600">{{ $registrationCount }}</span>
        <span class="stat-description">Course registrations completed.</span>
    </div>
</div>

<div class="card-accent mt-8">
    <h2 class="text-xl font-semibold text-slate-900">🎉 Welcome back</h2>
    <p class="mt-2 text-slate-600">Use the navigation above to manage student records, courses, course enrollment, and reports.</p>
</div>
@endsection
