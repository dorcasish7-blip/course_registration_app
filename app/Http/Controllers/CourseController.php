<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::orderBy('course_id', 'asc')->get(),
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:20',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:20',
        ]);

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $course->delete();

            // Re-number remaining courses sequentially
            $remaining = Course::orderBy('course_id')->get();
            $counter = 1;
            foreach ($remaining as $c) {
                if ($c->course_id !== $counter) {
                    $oldId = $c->course_id;
                    // Update registrations referencing this course
                    Registration::where('course_id', $oldId)
                        ->update(['course_id' => $counter]);
                    // Update the course's primary key
                    DB::table('courses')
                        ->where('course_id', $oldId)
                        ->update(['course_id' => $counter]);
                }
                $counter++;
            }

            // Reset AUTO_INCREMENT to next available value
            $maxId = Course::max('course_id') ?? 0;
            DB::statement("ALTER TABLE courses AUTO_INCREMENT = " . ($maxId + 1));

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();
        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('courses.index')->with('success', 'Course removed and IDs re-arranged.');
    }
}
