<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => null,
            'password' => bcrypt('password123'),
        ]);

        Student::create([
            'name' => 'Alice Uwase',
            'program' => 'Computer Science',
        ]);

        Student::create([
            'name' => 'Brian Nkurunziza',
            'program' => 'Information Systems',
        ]);

        Course::create(['course_name' => 'Database Systems', 'credits' => 3]);
        Course::create(['course_name' => 'Web Development', 'credits' => 4]);
        Course::create(['course_name' => 'Algorithms', 'credits' => 3]);
    }
}
