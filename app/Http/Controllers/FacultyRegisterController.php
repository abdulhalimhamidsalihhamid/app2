<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FacultyMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class FacultyRegisterController extends Controller
{
   public function register(Request $request)
{
    $request->validate([
        'name'              => 'required|string|max:255',
        'email'             => 'required|email',
        'specialty'         => 'required|string|max:255',
        'degree'            => 'required|string|max:255',
        'password'          => 'required|string|min:6|confirmed',
    ]);

    // جلب جميع السجلات وفك التشفير ومقارنة البريد
    $existing = FacultyMember::all()->first(function($user) use ($request) {
        try {
            return Crypt::decryptString($user->email) === $request->email;
        } catch (\Exception $e) {
            return false;
        }
    });

    if ($existing) {
        return back()->withErrors(['email' => 'هذا البريد الإلكتروني مستخدم من قبل.'])->withInput();
    }

    FacultyMember::create([
        'name'      => Crypt::encryptString($request->name),
        'email'     => Crypt::encryptString($request->email),
        'specialty' => Crypt::encryptString($request->specialty),
        'degree'    => Crypt::encryptString($request->degree),
        'password'  => Hash::make($request->password),
    ]);

    return redirect()->route('users.login')->with('success', 'تم إنشاء الحساب بنجاح');
}
    // عملية تسجيل الدخول
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // جلب جميع الأساتذة وفك التشفير ومطابقة البريد
    $user = FacultyMember::all()->first(function($member) use ($credentials) {
        try {
            return Crypt::decryptString($member->email) === $credentials['email'];
        } catch (\Exception $e) {
            return false;
        }
    });

    // تحقق من وجود المستخدم وتطابق كلمة المرور
    if ($user && Hash::check($credentials['password'], $user->password)) {
        // تخزين بيانات تسجيل الدخول يدويًا في السيشن
        session(['faculty_id' => $user->id]);
        return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح');
    }

    return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
}


    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function showEditForm()
    {
        $faculty = FacultyMember::findOrFail(session('faculty_id'));

        // إنشاء حقول مكشوفة لفك التشفير في العرض
        $faculty->name_plain = Crypt::decryptString($faculty->name);
        $faculty->email_plain = Crypt::decryptString($faculty->email);
        $faculty->specialty_plain = Crypt::decryptString($faculty->specialty);
        $faculty->degree_plain = Crypt::decryptString($faculty->degree);

        return view('users.update_data_user', ['member' => $faculty]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'specialty' => 'required|string|max:255',
            'degree'    => 'required|string|max:255',
            'password'  => 'nullable|string|min:6|confirmed',
        ]);

        $faculty = FacultyMember::findOrFail(session('faculty_id'));

        $faculty->name      = Crypt::encryptString($request->name);
        $faculty->email     = Crypt::encryptString($request->email);
        $faculty->specialty = Crypt::encryptString($request->specialty ?? '');
        $faculty->degree    = Crypt::encryptString($request->degree ?? '');

        if ($request->filled('password')) {
            $faculty->password = Hash::make($request->password);
        }

        $faculty->save();

        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
