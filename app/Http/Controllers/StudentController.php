<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', [
            'students' => Student::orderBy('student_id', 'asc')->get(),
        ]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'program' => 'required|string|max:255',
        ]);

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'program' => 'required|string|max:255',
        ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $student->delete();

            // Re-number remaining students sequentially
            $remaining = Student::orderBy('student_id')->get();
            $counter = 1;
            foreach ($remaining as $s) {
                if ($s->student_id !== $counter) {
                    $oldId = $s->student_id;
                    // Update registrations referencing this student
                    Registration::where('student_id', $oldId)
                        ->update(['student_id' => $counter]);
                    // Update the student's primary key
                    DB::table('students')
                        ->where('student_id', $oldId)
                        ->update(['student_id' => $counter]);
                }
                $counter++;
            }

            // Reset AUTO_INCREMENT to next available value
            $maxId = Student::max('student_id') ?? 0;
            DB::statement("ALTER TABLE students AUTO_INCREMENT = " . ($maxId + 1));

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();
        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('students.index')->with('success', 'Student removed and IDs re-arranged.');
    }
}
