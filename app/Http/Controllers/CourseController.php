<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
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
        if (!$facultyId) {
            return redirect()->route('users.login');
        }

        $courses = Course::where('faculty_member_id', $facultyId)->get();
        return view('materials.add_materials', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $facultyId = session('faculty_id');
        if (!$facultyId) {
            return redirect()->route('login.form');
        }

        Course::create([
            'faculty_member_id' => $facultyId,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المقرر بنجاح');
    }

    public function destroy($id)
    {
        $facultyId = session('faculty_id');
        $course = Course::where('id', $id)->where('faculty_member_id', $facultyId)->firstOrFail();
        $course->delete();

        return redirect()->back()->with('success', 'تم حذف المقرر بنجاح');
    }
}
