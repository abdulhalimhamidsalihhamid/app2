<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacultyMember;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FacultyMemberSeeder extends Seeder
{
    public function run(): void
    {

// ✅ إنشاء 2 أدمن
    FacultyMember::create([
        'name'              => Crypt::encryptString('Admin User 1'),
        'email'             => Crypt::encryptString('admin1@example.com'),
        'specialty'         => Crypt::encryptString('Administration'),
        'degree'            => Crypt::encryptString('PhD'),
        'password'          => Hash::make('password123'),
        'role'              => Crypt::encryptString('admin'),
        'email_verified_at' => Carbon::now(),
    ]);

    FacultyMember::create([
        'name'              => Crypt::encryptString('Admin User 2'),
        'email'             => Crypt::encryptString('admin2@example.com'),
        'specialty'         => Crypt::encryptString('Administration'),
        'degree'            => Crypt::encryptString('Master'),
        'password'          => Hash::make('password123'),
        'role'              => Crypt::encryptString('admin'),
        'email_verified_at' => Carbon::now(),
    ]);

    // ✅ إنشاء 5 مدرسين
    for ($i = 1; $i <= 5; $i++) {
        FacultyMember::create([
            'name'              => Crypt::encryptString("Teacher $i"),
            'email'             => Crypt::encryptString("teacher$i@example.com"),
            'specialty'         => Crypt::encryptString('Computer Science'),
            'degree'            => Crypt::encryptString('Master'),
            'password'          => Hash::make('password123'),
            'role'              => Crypt::encryptString('teacher'),
            'email_verified_at' => Carbon::now(),
        ]);
    }

    // ✅ إنشاء 5 طلاب
    for ($i = 1; $i <= 5; $i++) {
        FacultyMember::create([
            'name'              => Crypt::encryptString("Student $i"),
            'email'             => Crypt::encryptString("student$i@example.com"),
            'specialty'         => Crypt::encryptString('Software Engineering'),
            'degree'            => Crypt::encryptString('Bachelor'),
            'password'          => Hash::make('password123'),
            'role'              => Crypt::encryptString('student'),
            'email_verified_at' => Carbon::now(),
        ]);
    }
}


    }

