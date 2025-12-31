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

        $messages = \App\Models\Message::with(['sender','student','group'])->latest()->paginate(10);
        $students = \App\Models\Student::all();
        $groups   = \App\Models\Group::all();

        return view('admin.message', compact('messages','students','groups'));
    }

}
  
