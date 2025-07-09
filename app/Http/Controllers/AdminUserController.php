<?php

namespace App\Http\Controllers;

use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminUserController extends Controller
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
        $users = FacultyMember::all();
        return view('admin.index', compact('users'));
    }

    public function edit($id)
    {
        $user = FacultyMember::findOrFail($id);
        return view('admin.edit', [
            'user' => $user,
            'decrypted' => [
                'name' => Crypt::decryptString($user->name),
                'email' => Crypt::decryptString($user->email),
                'specialty' => Crypt::decryptString($user->specialty),
                'degree' => Crypt::decryptString($user->degree),
                'role' => Crypt::decryptString($user->role),
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'specialty' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'role' => 'required|string'
        ]);

        $user = FacultyMember::findOrFail($id);
        $user->name = Crypt::encryptString($request->name);
        $user->email = Crypt::encryptString($request->email);
        $user->specialty = Crypt::encryptString($request->specialty);
        $user->degree = Crypt::encryptString($request->degree);
        $user->role = Crypt::encryptString($request->role);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy($id)
    {
        FacultyMember::destroy($id);
        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }

}
