<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
       
    // 1. Validatsiya
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
        'role' => 'required|in:student,parent', // Ikkalasini qabul qiladi
    ]);

    // 2. Foydalanuvchini topish
    $user = User::where('email', $request->email)
                ->where('role', $request->role)
                ->first();

    // 3. Tekshirish
    if (!$user || !\Hash::check($request->password, $user->password)) {
        return back()->withErrors(['login_error' => 'Email yoki parol noto‘g‘ri']);
    }

    // 4. Login
    auth()->login($user);

    // 5. Rolga qarab redirect
    if ($user->role === 'student') {
        return redirect('/');
    } elseif ($user->role === 'parent') {
        return redirect('/parent');
    }

    // Agar boshqa rol bo‘lsa (kamdan-kam hollarda)
    return redirect('/');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }



    // -----------------------------------------------------------------------------
    // Admin
    public function adminLogin(Request $request)
    {
        return view('auth.admin.login');
    }
    public function loginAdmin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $user = User::where('email', $request->email)
                ->where('role', $request->role)
                ->first();

    if (!$user || !\Hash::check($request->password, $user->password)) {
        return back()->withErrors(['login_error' => 'Email yoki parol noto‘g‘ri']);
    }

    auth()->login($user);
    return redirect('/admin');
}

}
