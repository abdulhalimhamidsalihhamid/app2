<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FacultyMember;
use App\Mail\AdminSendMessageMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;


class AdminDashboardController extends Controller
{
        public function __construct()
    {
        $facultyId = session('faculty_id');

        if (!$facultyId) {
            abort(403, 'يجب تسجيل الدخول أولاً.');
        }

        $faculty = FacultyMember::find($facultyId);

        if (!$faculty || Crypt::decryptString($faculty->role) !== 'admin') {
            abort(403, 'ليس لديك صلاحية الوصول.');
        }
    }
    
    public function index()
    {
        // جلب المستخدمين مع فك تشفير الأسماء
        $members = FacultyMember::all()->map(function ($member) {
            $member->name = Crypt::decryptString($member->name);
            $member->email = Crypt::decryptString($member->email);
            return $member;
        });

        return view('admin.dashboard', compact('members'));
    }

    public function create()
{
    $users = FacultyMember::all();
    return view('admin.create', compact('users'));
}

public function store(Request $request)
{
    $request->validate([
        'faculty_member_id' => 'required|exists:faculty_members,id',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $user = FacultyMember::findOrFail($request->faculty_member_id);
    $email = Crypt::decryptString($user->email);
    $name = Crypt::decryptString($user->name);

    Mail::to($email)->send(new AdminSendMessageMail($name, $request->subject, $request->message));

    return back()->with('success', 'تم إرسال الرسالة بنجاح.');
}
}
