<?php

namespace App\Http\Controllers;

use App\Models\TrainingVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingVideoController extends Controller
{
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
