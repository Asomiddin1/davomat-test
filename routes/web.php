<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

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
    Route::get('/admin', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/dars-jadvali', [HomeController::class, 'studentDashboard'])->name('student.dashboard');
    Route::get('/parent', [HomeController::class, 'parentDashboard'])->name('parent.dashboard');

    // 🧑‍🎓 Studentga oid sahifalar
    Route::get('/info', [StudentController::class, 'studentInfo'])->name('student.info');
    Route::get('/plans', [StudentController::class, 'plans'])->name('student.plans');
    Route::get('/message', [StudentController::class, 'message'])->name('student.message');
    Route::get('/pomidor', [StudentController::class, 'pomidor'])->name('student.pomidor');
    // admin sahifalari
    Route::get('/groups', [AdminController::class, 'groups'])->name('admin.groups');
    Route::get('/admins', [AdminController::class, 'admins'])->name('admin.admins');
    Route::get('/admin-message', [AdminController::class, 'adminMessage'])->name('admin.message');
    Route::get('/create-student', [AdminController::class, 'createStudent'])->name('admin.create.student');
    Route::post('/create-student', [AdminController::class, 'createStudentUser'])->name('admin.create.student.post');
});