<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FacultyMember;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacultyVerificationMail;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\FacultyEmailVerification;

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
        $existing = FacultyMember::all()->first(function ($user) use ($request) {
            try {
                return Crypt::decryptString($user->email) === $request->email;
            } catch (\Exception $e) {
                return false;
            }
        });

        if ($existing) {
            return back()->withErrors(['email' => 'هذا البريد الإلكتروني مستخدم من قبل.'])->withInput();
        }


        $faculty = FacultyMember::create([
            'name'      => Crypt::encryptString($request->name),
            'email'     => Crypt::encryptString($request->email),
            'specialty' => Crypt::encryptString($request->specialty),
            'degree'    => Crypt::encryptString($request->degree),
            'password'  => Hash::make($request->password),
        ]);


        $decryptedEmail = $request->email;
        $decryptedName = $request->name;

        $url = URL::temporarySignedRoute(
            'faculty.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $faculty->id]
        );

        // إرسال البريد
        Mail::to($decryptedEmail)->send(new FacultyVerificationMail($decryptedName, $url));

        return redirect()->route('users.login')
            ->with('success', 'تم إنشاء الحساب بنجاح. تحقق من بريدك الإلكتروني لتفعيل الحساب.');
    }




    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // جلب جميع الأساتذة وفك التشفير ومطابقة البريد
        $user = FacultyMember::all()->first(function ($member) use ($credentials) {
            try {
                return Crypt::decryptString($member->email) === $credentials['email'];
            } catch (\Exception $e) {
                return false;
            }
        });

        // تحقق من وجود المستخدم وتطابق كلمة المرور
        if ($user && Hash::check($credentials['password'], $user->password)) {

            // التحقق من تفعيل الحساب
            if (is_null($user->email_verified_at)) {
                $decryptedEmail = $request->email;
                $decryptedName = Crypt::decryptString($user->name);

                $url = URL::temporarySignedRoute(
                    'faculty.verify',
                    Carbon::now()->addMinutes(60),
                    ['id' => $user->id]
                );

                Mail::to($decryptedEmail)->send(new FacultyVerificationMail($decryptedName, $url));

                return back()->withErrors(['email' => 'يرجى تفعيل البريد الإلكتروني أولاً'])->withInput();
            }

            // ✅ إرسال إشعار دخول بالبريد
            $userAgent = $request->header('User-Agent');
            $ip = $request->ip();

            // استعلام موقع المستخدم
            $locationInfo = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,regionName,city,lat,lon")->json();

            $location = 'لم يتم تحديد الموقع';
            $mapLink = '';
            if ($locationInfo && $locationInfo['status'] === 'success') {
                $location = "{$locationInfo['country']}, {$locationInfo['regionName']}, {$locationInfo['city']}";
                $mapLink = "https://www.google.com/maps?q={$locationInfo['lat']},{$locationInfo['lon']}";
            }

            $decryptedEmail = Crypt::decryptString($user->email);
            $decryptedName = Crypt::decryptString($user->name);

            Mail::raw("
            عزيزي {$decryptedName}،

            تم تسجيل الدخول إلى حسابك بنجاح.

            📅 التاريخ: " . now()->format('Y-m-d H:i:s') . "
            🌐 المتصفح: {$userAgent}
            📍 الموقع: {$location}
            🗺️ عرض الموقع على الخريطة: {$mapLink}

            إذا لم تكن أنت من قام بتسجيل الدخول، يرجى تغيير كلمة المرور فوراً.
        ", function ($message) use ($decryptedEmail) {
                $message->to($decryptedEmail)
                    ->subject('تنبيه: تم تسجيل الدخول إلى حسابك');
            });

            // ✅ تخزين الجلسة
            session(['faculty_id' => $user->id]);

            return redirect()->route('home');
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


    public function verify(Request $request, $id)
    {
        //  dd(get_class($request));
        if (!$request->hasValidSignature()) {
            abort(401, 'الرابط غير صالح أو منتهي.');
        }

        $faculty = FacultyMember::findOrFail($id);
        $faculty->email_verified_at = Carbon::now();
        $faculty->save();

        return redirect()->route('users.login')->with('success', 'تم تفعيل البريد الإلكتروني بنجاح.');
    }
}
