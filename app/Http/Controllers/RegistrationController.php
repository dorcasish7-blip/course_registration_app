<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('enrollment.create', [
            'students' => Student::orderBy('name')->get(),
            'courses' => Course::orderBy('course_name')->get(),
            'registrations' => Registration::with(['student', 'course'])->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
        ]);

        $exists = Registration::where('student_id', $data['student_id'])
            ->where('course_id', $data['course_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['course_id' => 'This student is already registered for the selected course.'])->withInput();
        }

        Registration::create($data);

        return redirect()->route('enrollment.create')->with('success', 'Student enrolled in course successfully.');
    }

    public function index()
    {
        return view('reports.index', [
            'students' => Student::withCount('courses')->orderBy('name')->get(),
        ]);
    }

    public function studentReport(Student $student)
    {
        $student->load('courses');

        return view('reports.student', [
            'student' => $student,
        ]);
    }
}
