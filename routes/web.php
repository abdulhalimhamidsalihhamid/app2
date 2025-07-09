<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TrainingVideoController;
use App\Http\Controllers\Admin\AdminDashboardController;

use App\Http\Controllers\StudentDashboardController;


// الواجهة الرئيسية
Route::get('/', function () {

     // حماية كل الدوال داخل هذا الكنترولر
        if (!Session::has('faculty_id')) {
        return  redirect()->route('users.login');
        }

     return view('home.home');
    })->name('home');
Route::get('/verify-email/{id}', [App\Http\Controllers\FacultyRegisterController::class, 'verify'])->name('faculty.verify');

Route::get('/logout', function () {
    Session::forget('faculty_id');
    return redirect()->route('users.login'); // وجهه إلى صفحة تسجيل الدخول
})->name('users.logout');

// مجموعة المستخدمين
Route::prefix('users')->group(function () {
    Route::get('/login', fn() => view('users.login'))->name('users.login');
    Route::post('/login', [App\Http\Controllers\FacultyRegisterController::class, 'login'])->name('login');

    Route::get('/register', fn() => view('users.registration'))->name('users.register');
    Route::post('/register', [App\Http\Controllers\FacultyRegisterController::class, 'register'])->name('register');



    Route::get('/edit-profile', [App\Http\Controllers\FacultyRegisterController::class, 'showEditForm'])->name('users.edit');
    Route::post('/edit-profile', [App\Http\Controllers\FacultyRegisterController::class, 'update'])->name('users.update');

    Route::get('/home', fn() => view('home.home'))->name('users.home');



});

// مجموعة الطلاب
Route::prefix('students')->group(function () {



    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');


    Route::get('/grades', [GradeController::class, 'index'])->name('students.grades');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    // Route::get('/grades/students/{courseId}', [GradeController::class, 'fetchStudents'])->name('grades.students');
    Route::get('/grades/students/{courseId}', [GradeController::class, 'students'])->name('grades.students');


    // Route::get('/grades', fn() => view('student.add_grades'))->name('students.grades');
    Route::get('/home', fn() => view('student.home'))->name('students.home');
});

// مجموعة الملفات
Route::prefix('files')->group(function () {

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/download/{id}', [BookController::class, 'download'])->name('books.download');
});

// مجموعة المقررات الدراسية
Route::prefix('materials')->group(function () {

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

// مجموعة الفيديوهات
Route::prefix('videos')->group(function () {

    Route::get('/videos', [TrainingVideoController::class, 'index'])->name('videos.index');
    Route::post('/videos', [TrainingVideoController::class, 'store'])->name('videos.store');
    Route::delete('/videos/{video}', [TrainingVideoController::class, 'destroy'])->name('videos.destroy');
});


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // صفحة الإعدادات الشخصية للمشرف


    // إرسال رسالة جديدة
Route::get('/admin/messages/create', [AdminDashboardController::class, 'create'])->name('admin.messages.create');
Route::post('/admin/messages/store', [AdminDashboardController::class, 'store'])->name('admin.messages.store');
    // عرض المستخدمين
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});


Route::prefix('students')->group(function () {


Route::get('/student/dashboard', [StudentDashboardController::class, 'dashboard'])->name('student.dashboard');
Route::get('/student/videos', [StudentDashboardController::class, 'videos'])->name('student.videos');
Route::get('/student/books', [StudentDashboardController::class, 'books'])->name('student.books');
Route::get('/student/grades', [StudentDashboardController::class, 'grades'])->name('student.grades');

});
