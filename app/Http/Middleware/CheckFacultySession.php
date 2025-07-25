<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Session;

class CheckFacultySession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('faculty_id')) {
            return redirect()->route('login'); // غيّر 'login' حسب اسم route صفحة الدخول
        }

        return $next($request);
    }
}
