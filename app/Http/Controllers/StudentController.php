<?php
namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function studentInfo()
    {
        if(Auth::user()->role !== 'student'){
            abort(403, 'Siz bunaqa sahifaga kira olmaysiz.');
        }
        return view('student.student-info');
    }
    public function plans()
    {
        if(Auth::user()->role !== 'student'){
            abort(403, 'Siz bunaqa sahifaga kira olmaysiz.');
        }
         return view('student.plans');
    }
    public function message()
    {
        if(Auth::user()->role !== 'student'){
            abort(403, 'Siz bunaqa sahifaga kira olmaysiz.');
        }
        return view('student.message');
    }
    public function pomidor()
    {
        if(Auth::user()->role !== 'student'){
            abort(403, 'Siz bunaqa sahifaga kira olmaysiz.');
        }
        return view('student.pomidor');
    }

}