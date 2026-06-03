@extends('layouts.app')

@section('title', 'Student Report')

@section('content')
<div class="card-accent">
    <div class="card-header">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">📝 Course Report</h1>
            <p class="mt-1 text-slate-600">{{ $student->name }} — <span class="badge-purple">{{ $student->program }}</span></p>
        </div>
        <a href="{{ route('reports.index') }}" class="btn-ghost btn-sm">&larr; Back</a>
    </div>

    <div class="table-container mt-2">
        <table class="table-base">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Credits</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->courses as $course)
                    <tr>
                        <td class="font-medium text-slate-900">{{ $course->course_name }}</td>
                        <td><span class="badge-blue">{{ $course->credits }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <div class="empty-state">
                                <span class="empty-state-icon">📝</span>
                                <p class="empty-state-text">No courses enrolled.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
