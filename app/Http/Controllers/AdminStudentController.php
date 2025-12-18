<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class AdminStudentController extends Controller
{
    // =========================
    // Talabalar ro'yxati
    // =========================
    
   public function createStudent(Request $request)
{
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
    }

    // Qidiruv so'rovi
    $search = $request->query('search');

    if ($search) {
        $students = Student::where('student_id', 'LIKE', "%{$search}%")
            ->orWhere('fullname', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone_number', 'LIKE', "%{$search}%")
            ->get();
    } else {
        $students = Student::all();
    }

    return view('admin.create-student', compact('students', 'search'));
}

    // =========================
    // Talaba yaratish
    // =========================
    public function createStudentUser(Request $request)
{
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
    }
    // Validation
    $request->validate([
        'student_id'   => 'required|string|unique:students,student_id',
        'fullname'     => 'required|string|max:255',
        'email'        => 'required|string|email|max:255|unique:users,email',
        'password'     => 'required|string|min:8|confirmed', // password confirmation bilan
        'phone_number' => 'nullable|string|max:20',
    ]);

    // 1️⃣ User yaratish
    $user = new User();
    $user->name = $request->input('fullname');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->role = 'student';
    $user->save();

    // 2️⃣ Student profile yaratish
    $student = new Student();
    $student->user_id = $user->id; // User bilan bog‘lanadi
    $student->student_id = $request->input('student_id');
    $student->fullname = $request->input('fullname');
    $student->email = $request->input('email');
    $student->phone_number = $request->input('phone_number');
    $student->save();
     ToastMagic::success('Talaba muvaffaqiyatli yaratildi. !!!');

    return redirect('/admin/create-student')->with('success', 'Talaba va user muvaffaqiyatli yaratildi.');
}

public function updateStudent(Request $request, $id) 
{
    $student = Student::findOrFail($id);

    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:students,email,' . $student->id,
        'phone_number' => 'nullable|string|max:20',
    ]);

    $student->fullname = $request->input('fullname');
    $student->email = $request->input('email');
    $student->phone_number = $request->input('phone_number');
    $student->save();
     ToastMagic::success('Talaba muvaffaqiyatli yangilandi. !!!');

    return redirect()->route('admin.create-student')->with('success', 'Talaba muvaffaqiyatli yangilandi!');
}


public function deleteStudent($id)
{
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
    }

    $student = Student::findOrFail($id);
    $user = User::findOrFail($student->user_id);

    // Talaba va userni o'chirish
    $student->delete();
    $user->delete();
    ToastMagic::success('Talaba muvaffaqiyatli o‘chirildi. !!!');

    return redirect('/admin/create-student')->with('success', 'Talaba va user muvaffaqiyatli o\'chirildi.');


}

}