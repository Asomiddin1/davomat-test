<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function studentInfo(){
       return view('student.student-info');
   }

   public function  plans(){
    return view('student.plans');
   }
   public function message(){
    return view('student.message');
   }
   public function pomidor(){
    return view('student.pomidor');
   }
}
