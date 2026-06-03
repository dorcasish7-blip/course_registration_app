@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="page-header">
    <div>
        <h1>📊 Student Reports</h1>
        <p>See enrolled courses for each student.</p>
    </div>
</div>

<div class="table-container">
    <table class="table-base">
        <thead>
            <tr>
                <th>Student</th>
                <th>Program</th>
                <th>Courses</th>
                <th>Report</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td class="font-medium text-slate-900">{{ $student->name }}</td>
                    <td><span class="badge-purple">{{ $student->program }}</span></td>
                    <td><span class="badge-blue">{{ $student->courses_count }} enrolled</span></td>
                    <td>
                        <a href="{{ route('reports.student', $student) }}" class="btn-secondary btn-sm">📄 View report</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-state-icon">📊</span>
                            <p class="empty-state-text">No students available.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
