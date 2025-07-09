<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_member_id', 'name', 'author', 'description', 'category', 'file_path'];

    public function facultyMember()
    {
        return $this->belongsTo(FacultyMember::class);
    }
    
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        return in_array($key, ['name', 'author', 'description', 'category', 'file_path']) ? Crypt::decryptString($value) : $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, ['name', 'author', 'description', 'category', 'file_path'])) {
            $value = Crypt::encryptString($value);
        }
        return parent::setAttribute($key, $value);
    }
}
