<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Grade extends Model
{
    protected $fillable = ['student_id', 'course_id','faculty_member_id', 'mid_term', 'final_term'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Mutator لتشفير درجة منتصف الفصل
    public function setMidTermAttribute($value)
    {
        $this->attributes['mid_term'] = Crypt::encryptString($value);
    }

    // Accessor لفك تشفير درجة منتصف الفصل
    public function getMidTermAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    // Mutator لتشفير درجة النهائي
    public function setFinalTermAttribute($value)
    {
        $this->attributes['final_term'] = Crypt::encryptString($value);
    }

    // Accessor لفك تشفير درجة النهائي
    public function getFinalTermAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
