<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TrainingVideoController extends Controller
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
        $videos = TrainingVideo::where('faculty_id', $facultyId)->latest()->get();
        return view('videos.add_video', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'url'         => 'required|url',
            'category'    => 'nullable|string|max:100',
        ]);

        $facultyId = session('faculty_id');

        TrainingVideo::create([
            'faculty_id'  => $facultyId,
            'title'       => $request->title,
            'description' => $request->description,
            'url'         => $request->url,
            'category'    => $request->category,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الفيديو بنجاح');
    }

    public function destroy(TrainingVideo $video)
    {
        $video->delete();
        return redirect()->back()->with('success', 'تم حذف الفيديو');
    }
}
