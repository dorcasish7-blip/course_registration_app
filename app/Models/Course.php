<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_name',
        'credits',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'course_id', 'course_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'registrations', 'course_id', 'student_id', 'course_id', 'student_id');
    }
}
