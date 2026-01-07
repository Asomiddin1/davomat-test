<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;

// 🔹 Root sahifa
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔐 Oddiy foydalanuvchi logini (student/parent)
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('login.post');

// 🔐 Admin logini
Route::get('/auth/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.form');
Route::post('/auth/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');

// 🔐 Logout
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

// 🧑‍💼 Dashboardlar
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/lessons', [StudentController::class, 'lessons'])
        ->name('student.dashboard');
    Route::get('/parent', [HomeController::class, 'parentDashboard'])->name('parent.dashboard');

    // 🧑‍🎓 Studentga oid sahifalar
    Route::get('/info', [StudentController::class, 'studentInfo'])->name('student.info');
    Route::get('/plans', [StudentController::class, 'plans'])->name('student.plans');
    Route::get('/message', [StudentController::class, 'message'])->name('student.message');
    Route::get('/pomidor', [StudentController::class, 'pomidor'])->name('student.pomidor');


    // admin sahifalari
    Route::get('/admins', [AdminController::class, 'admins'])->name('admin.admins');
    Route::get('/admin/message', [AdminController::class, 'adminMessage'])->name('admin.message');
    // srudent crud
    Route::get('/admin/create-student', [AdminStudentController::class, 'createStudent'])->name('admin.create-student');
    Route::post('/admin/create-student', [AdminStudentController::class, 'createStudentUser'])->name('admin.create.student.post');
    Route::put('/admin/update-student/{id}', [AdminStudentController::class, 'updateStudent'])->name('admin.update.student'); 
    Route::delete('/delete-student/{id}', [AdminStudentController::class, 'deleteStudent'])->name('admin.delete.student');
    Route::get('/admin/students', [StudentController::class, 'index'])
    ->name('admin.students');
    // group crud
    Route::get('/admin/groups', [GroupController::class, 'index'])->name('admin.groups');
    Route::post('/admin/groups', [GroupController::class, 'createGroup'])->name('admin.create.group');
    Route::get('/admin/groups/{id}', [GroupController::class, 'show'])->name('admin.group.details');
    Route::post('/admin/groups/add-student', [GroupController::class, 'addStudent'])
    ->name('admin.groups.addStudent');
    Route::delete('/admin/groups/{group_id}/remove-student/{student_id}', [GroupController::class, 'removeStudent'])
    ->name('admin.remove.student.from.group');
    Route::put('/admin/groups/{group}', [GroupController::class, 'update'])->name('admin.groups.update');
    Route::patch('/admin/groups/{group}/status', [GroupController::class, 'status'])->name('admin.groups.status');
    Route::delete('/admin/groups/{group}', [GroupController::class, 'destroy'])->name('admin.groups.destroy');
    // Jadval Admin

   Route::resource('admin/lessons', LessonController::class)
    ->only(['index', 'store', 'destroy'])
    ->names('lessons');

   // teachers 
   Route::resource('/admin/teachers', TeacherController::class);
   Route::resource('admin/subjects', SubjectController::class)
    ->only(['index', 'store', 'destroy'])
    ->names('subjects');

    


});

// Admin Message
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('messages',[AdminMessageController::class,'index'])->name('messages.index');
    Route::post('messages',[AdminMessageController::class,'store'])->name('messages.store');
    Route::delete('messages/{message}',[AdminMessageController::class,'destroy'])->name('messages.destroy');
});

Route::post('/student/messages/{message}/read',
    [StudentController::class, 'markAsRead']
)->middleware('auth');

