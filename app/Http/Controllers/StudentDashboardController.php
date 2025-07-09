<?php

namespace App\Http\Controllers;



use App\Models\Book;
use App\Models\trainingVideo;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\FacultyMember;
use App\Models\Grade;

class StudentDashboardController extends Controller
{

    public function dashboard()
    {
        $studentId = session('student_id');

        $videosCount = trainingVideo::count();
        $booksCount = Book::count();
        $gradesCount = Grade::where('student_id', $studentId)->count();

        return view('student.dashboard', [
            'videos_count' => $videosCount,
            'books_count' => $booksCount,
            'grades_count' => $gradesCount,
        ]);
    }
    public function videos(Request $request)
{
    // جلب كل المدرسين لعرضهم في الـ Select
    $facultyMembers = FacultyMember::all();

    // إذا تم اختيار مدرس
    $facultyId = $request->get('faculty_id');
    $videosQuery = trainingVideo::query();

    if ($facultyId) {
        $videosQuery->where('faculty_id', $facultyId);
    }

    $videos = $videosQuery->with('facultyMember')->get();

    return view('student.videos', compact('videos', 'facultyMembers', 'facultyId'));
}
public function books(Request $request)
{
    $facultyMembers = FacultyMember::all();
    $facultyId = $request->get('faculty_id');

    $booksQuery = Book::query();

    if ($facultyId) {
        $booksQuery->where('faculty_member_id', $facultyId);
    }

    $books = $booksQuery->with('facultyMember')->get();

    return view('student.books', compact('books', 'facultyMembers', 'facultyId'));
}
public function grades()
{
    // نفترض أنك خزّنت ID الطالب في السيشن عند تسجيل الدخول
    $studentId = session('faculty_id');

    if (!$studentId) {
        return redirect()->route('login')->withErrors(['message' => 'يرجى تسجيل الدخول أولاً']);
    }

    $grades = Grade::where('student_id', $studentId)
        ->with('course')
        ->get();

    return view('student.grades', compact('grades'));
}
}
