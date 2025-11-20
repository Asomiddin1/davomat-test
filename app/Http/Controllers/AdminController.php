<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }
        return view('admin.dashboard');
    }
    public function groups()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }
        return view('admin.groups');
    }
    public function admins()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }
        return view('admin.admins');
    }
    public function adminMessage()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }
        return view('admin.message');
    }
    public function createStudent()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }
        return view('admin.create-student');
    }
    

    // Create Student user
    public function createStudentUser(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }

        $request->validate([
            'student_id' => 'required|string|unique:students',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $student = new User();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->password = bcrypt($request->input('password'));
        $student->role = 'student';
        $student->save();

        $studentProfile = new Student();
        $studentProfile->user_id = $student->id;
        $studentProfile->student_id = $request->input('student_id');
        $studentProfile->fullaname = $request->input('name');
        $studentProfile->email = $request->input('email');
        $studentProfile->phone_number = $request->input('phone_number');
        $studentProfile->group_name = $request->input('group_name');
        $studentProfile->save();
         
        ToastMagic::success('Talaba muvaffaqiyatli yaratildi. !!!');
        return redirect()->route('admin.create.student')->with('success', 'Talaba muvaffaqiyatli yaratildi.');
    }
}
