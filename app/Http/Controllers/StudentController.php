<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function __construct()
    {
        if (!Session::has('faculty_id')) {
            abort(403, 'غير مصرح بالدخول.');
        }
    }

    public function index()
    {
        $facultyId = session('faculty_id');

        $courses = Course::where('faculty_member_id', $facultyId)->get();

        // جلب كل الطلاب (faculty_members) الذين role = student
        $studentsOptions = FacultyMember::all()->filter(function ($user) {
            try {
                return Crypt::decryptString($user->role) === 'student';
            } catch (\Exception $e) {
                return false;
            }
        });

        // جلب الطلاب المضافين إلى جدول students
        $students = Student::with(['course', 'facultyMember'])
            ->where('faculty_member_id', $facultyId)
            ->get();

        return view('student.add_student', compact('courses', 'students', 'studentsOptions'));
    }

    public function store(Request $request)
    {
 
        $request->validate([
            'student_id' => 'required|exists:faculty_members,id',
            'course_id'  => 'required|exists:courses,id',
        ]);

        Student::create([
            'student_id'        => $request->student_id,
            'course_id'         => $request->course_id,
            'faculty_member_id' => session('faculty_id'),
        ]);

        return redirect()->route('students.index')->with('success', 'تمت إضافة الطالب بنجاح');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'تم حذف الطالب');
    }
}
