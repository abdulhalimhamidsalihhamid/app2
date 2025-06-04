<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
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

        $books = Book::where('faculty_member_id', $facultyId)->get();
        return view('files.add_file', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'category' => 'required',
            'file' => 'required|mimes:pdf|max:20480'
        ]);

        $filePath = $request->file('file')->store('books', 'public');

        Book::create([
            'faculty_member_id' => session('faculty_id'),
            'name' => $request->name,
            'author' => $request->author,
            'description' => $request->description,
            'category' => $request->category,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الكتاب بنجاح.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        Storage::disk('public')->delete($book->file_path);
        $book->delete();
        return redirect()->back()->with('success', 'تم حذف الكتاب.');
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);
        return response()->download(storage_path("app/public/{$book->file_path}"));
    }
}
