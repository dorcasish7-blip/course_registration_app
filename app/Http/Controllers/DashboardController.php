<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'studentCount' => Student::count(),
            'courseCount' => Course::count(),
            'registrationCount' => Registration::count(),
        ]);
    }
}
