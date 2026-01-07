<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teachers.index', [
            'teachers' => Teacher::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255'
        ]);

        Teacher::create($request->only('full_name'));

        return back()->with('success', 'O‘qituvchi qo‘shildi');
    }

    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return back()->with('success', 'O‘qituvchi o‘chirildi');
    }
}

