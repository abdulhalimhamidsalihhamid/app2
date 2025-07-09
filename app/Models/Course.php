<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'faculty_member_id'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function facultyMember()
    {
        return $this->belongsTo(FacultyMember::class);
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }


    public function getNameAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
