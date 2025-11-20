<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Root sahifaga kirganda avtomatik yo‘naltirish
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'student':
                    return redirect()->route('student.dashboard');
                case 'parent':
                    return redirect()->route('parent.dashboard');
                default:
                    return redirect()->route('login');
            }
        }

        return redirect()->route('login');
    }

    // 🔹 Admin dashboard
    public function adminDashboard()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }

        return view('admin.dashboard');
    }

    // 🔹 Student dashboard
    public function studentDashboard()
    {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }

        return view('student.welcome');
    }

    // 🔹 Parent dashboard
    public function parentDashboard()
    {
        if (Auth::user()->role !== 'parent') {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }

        return view('parent.welcome');
    }
}
