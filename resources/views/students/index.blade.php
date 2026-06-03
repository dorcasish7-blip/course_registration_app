@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="page-header">
    <div>
        <h1>🎓 Students</h1>
        <p>Create, edit, and remove student records.</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn-primary">+ New student</a>
</div>

<div class="table-container">
    <table class="table-base">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Program</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td class="font-medium text-slate-900">{{ $student->student_id }}</td>
                    <td class="text-slate-800">{{ $student->name }}</td>
                    <td><span class="badge-purple">{{ $student->program }}</span></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('students.edit', $student) }}" class="btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-state-icon">🎓</span>
                            <p class="empty-state-text">No students yet. Add your first student!</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
