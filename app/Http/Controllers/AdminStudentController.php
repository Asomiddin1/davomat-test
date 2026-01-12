<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // <--- YANGI QO‘SHILDI: Random string uchun
use Devrabiul\ToastMagic\Facades\ToastMagic;
use App\Mail\StudentCreatedMail;
use Illuminate\Support\Facades\Mail;

class AdminStudentController extends Controller
{
    // ... createStudent (list ko'rish) funksiyasi o'zgarishsiz qoladi ...
    public function createStudent(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }

        $search = $request->query('search');
        $students = Student::query();

        if ($search) {
            $students->where(function($q) use ($search) {
                $q->where('student_id', 'LIKE', "%{$search}%")
                  ->orWhere('fullname', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone_number', 'LIKE', "%{$search}%");
            });
        }

        $students = $students->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.create-student', compact('students', 'search'));
    }

    // =========================
    // TALABA YARATISH (RANDOM PAROL BILAN)
    // =========================
    public function createStudentUser(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Huquq yo‘q!');
        }

        // 1. Validatsiyadan 'password' ni olib tashladik
        $request->validate([
            'student_id'   => 'required|string|unique:students,student_id',
            'fullname'     => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            // 2. Parolni avtomatik generatsiya qilamiz (10 ta belgili)
            // Agar Laravel 10+ ishlatsangiz: Str::password(10) qilish ham mumkin (murakkabroq bo'ladi)
            $rawPassword = Str::random(6); 

            // 3. User yaratish
            $user = new User();
            $user->name = $request->input('fullname');
            $user->email = $request->input('email');
            $user->password = Hash::make($rawPassword); // Generatsiya qilingan parolni shifrlab yozamiz
            $user->role = 'student';
            $user->save();

            // 4. Student profile yaratish
            $student = new Student();
            $student->user_id = $user->id;
            $student->student_id = $request->input('student_id');
            $student->fullname = $request->input('fullname');
            $student->email = $request->input('email');
            $student->phone_number = $request->input('phone_number');
            $student->save();

            DB::commit();

            // 5. Email yuborish
            try {
                // Generatsiya qilingan $rawPassword ni emailga yuboramiz
                Mail::to($user->email)->send(new StudentCreatedMail($user, $rawPassword));
                ToastMagic::success('Talaba yaratildi. Parol emailga yuborildi!');
            } catch (\Exception $e) {
                ToastMagic::warning('Talaba yaratildi, lekin email ketmadi. Parol: ' . $rawPassword);
                // Eslatma: Haqiqiy loyihada parolni toastda chiqarish xavfli bo'lishi mumkin,
                // lekin email ishlamagan holatda admin bilishi uchun vaqtincha shu yerda qoldirdim.
            }

            return redirect()->route('admin.create-student');

        } catch (\Exception $e) {
            DB::rollBack();
            ToastMagic::error('Xatolik yuz berdi: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    // ... (updateStudent va deleteStudent funksiyalari o'zgarishsiz qoladi) ...
    public function updateStudent(Request $request, $id) 
    {
         if (Auth::user()->role !== 'admin') {
            abort(403, 'Huquq yo‘q!');
        }

        $student = Student::findOrFail($id);
        
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'phone_number' => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            $student->fullname = $request->input('fullname');
            $student->email = $request->input('email');
            $student->phone_number = $request->input('phone_number');
            $student->save();

            if ($student->user_id) {
                $user = User::find($student->user_id);
                if ($user) {
                    $user->name = $request->input('fullname');
                    $user->email = $request->input('email');
                    $user->save();
                }
            }

            DB::commit();
            ToastMagic::success('Talaba ma\'lumotlari yangilandi!');
            return redirect()->route('admin.create-student');

        } catch (\Exception $e) {
            DB::rollBack();
            ToastMagic::error('Yangilashda xatolik: ' . $e->getMessage());
            return back();
        }
    }

    public function deleteStudent($id)
    {
         if (Auth::user()->role !== 'admin') {
            abort(403, 'Huquq yo‘q!');
        }

        $student = Student::findOrFail($id);

        DB::beginTransaction();
        try {
            $user = User::find($student->user_id);
            $student->delete();
            if ($user) {
                $user->delete();
            }

            DB::commit();
            ToastMagic::success('Talaba to‘liq o‘chirildi!');
            return redirect()->route('admin.create-student');

        } catch (\Exception $e) {
            DB::rollBack();
            ToastMagic::error('O‘chirishda xatolik!');
            return back();
        }
    }
}