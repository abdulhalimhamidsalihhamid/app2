<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{

        public function __construct()
    {
        // حماية كل الدوال داخل هذا الكنترولر
        if (!Session::has('faculty_id')) {
            // في حال session غير موجودة، سيتم إعادة التوجيه لصفحة الدخول
            abort(403, 'غير مصرح بالدخول.'); // أو يمكنك استخدام redirect()->route('login')
        }
    }
    public function index()
    {

        $facultyId = session('faculty_id');
        $courses = Course::where('faculty_member_id', $facultyId)->get();
        $students = Student::with('course')->whereIn('course_id', $courses->pluck('id'))->get();

        return view('student.add_student', compact('courses', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'course_id' => 'required|exists:courses,id'
        ]);

        Student::create($request->only('name', 'course_id'));

        return redirect()->route('students.index')->with('success', 'تمت إضافة الطالب بنجاح');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'تم حذف الطالب');
    }
}
