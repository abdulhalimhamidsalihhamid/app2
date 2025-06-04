<?php

// app/Http/Controllers/GradeController.php
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Course;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GradeController extends Controller
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
        $courses = Course::all();
        return view('student.add_grades', compact('courses'));
    }

    public function students($courseId)
{
    $students = Student::where('course_id', $courseId)
    ->with(['grades' => fn($query) => $query->where('course_id', $courseId)])
    ->get();


    return response()->json($students);
}

    public function store(Request $request)
    {
        $data = $request->input('grades');
        foreach ($data as $grade) {
            Grade::updateOrCreate(
            [
                'student_id' => $grade['student_id'],
                'course_id' => $request->course_id,
            ],
            [
                'mid_term' => $grade['mid'],
                'final_term' => $grade['final'],
            ]
        );
        }
        return redirect()->back()->with('success', 'تم حفظ الدرجات بنجاح');
    }



}
