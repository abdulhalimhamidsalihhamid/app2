<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    protected $fillable = ['student_id', 'faculty_member_id', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function facultyMember()
    {
        return $this->belongsTo(FacultyMember::class, 'student_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }


}
