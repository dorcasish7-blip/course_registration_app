@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="page-header">
    <div>
        <h1>📖 Courses</h1>
        <p>Add and manage courses for student enrollment.</p>
    </div>
    <a href="{{ route('courses.create') }}" class="btn-primary">+ New course</a>
</div>

<div class="table-container">
    <table class="table-base">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td class="font-medium text-slate-900">{{ $course->course_id }}</td>
                    <td class="text-slate-800">{{ $course->course_name }}</td>
                    <td><span class="badge-blue">{{ $course->credits }} credits</span></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('courses.edit', $course) }}" class="btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-sm" onclick="return confirm('Delete this course?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-state-icon">📚</span>
                            <p class="empty-state-text">No courses yet. Add your first course!</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
