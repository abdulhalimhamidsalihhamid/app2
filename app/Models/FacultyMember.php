<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyMember extends Model
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'specialty', 'degree', 'password','email_verified_at',
    ];

}
