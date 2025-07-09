<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class TrainingVideo extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id', 'title', 'description', 'url', 'category'];

    public function getTitleAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Crypt::encryptString($value);
    }

    public function getDescriptionAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getUrlAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = Crypt::encryptString($value);
    }

    public function getCategoryAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = $value ? Crypt::encryptString($value) : null;
    }

    public function faculty()
    {
        return $this->belongsTo(FacultyMember::class);
    }
    public function facultyMember()
{
    return $this->belongsTo(FacultyMember::class, 'faculty_id');
}
}
