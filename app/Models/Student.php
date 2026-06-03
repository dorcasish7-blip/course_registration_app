<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'name',
        'program',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'student_id', 'student_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'student_id', 'course_id', 'student_id', 'course_id');
    }
}
