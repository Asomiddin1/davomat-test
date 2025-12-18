<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('admin.groups', compact('groups'));
    }
    public function createGroup(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
            'type' => 'required|string|max:255',
        ]);

        // Yangi group yaratish
        $group = new Group();
        $group->name = $request->input('name');
        $group->type = $request->input('type');
        $group->save();

        // Muvaffaqiyatli xabar
        ToastMagic::success('Yangi guruh muvaffaqiyatli yaratildi!');

        return redirect()->route('admin.groups');
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);
        $students = $group->students;   
        $allStudents = Student::all();
        return view('admin.group-details', compact('group', 'students', 'allStudents'));
    }
    public function addStudent(Request $request)
{
    $request->validate([
        'group_id'   => 'required|exists:groups,id',
        'student_id' => 'required|exists:students,id',
    ]);

    $group = Group::findOrFail($request->group_id);

    // ❗ allaqachon borligini tekshirish (TO‘G‘RI)
    if ($group->students()
        ->wherePivot('student_id', $request->student_id)
        ->exists()) {

        return back()->with('error', 'Bu talaba allaqachon guruhda mavjud');
    }

    // ✅ pivot table orqali qo‘shish
    $group->students()->attach($request->student_id);

    return back()->with('success', 'Talaba guruhga muvaffaqiyatli qo‘shildi');
}

public function removeStudent($group_id, $student_id)
{
    $group = Group::findOrFail($group_id);

    // Pivot jadvalidan o'chirish
    $group->students()->detach($student_id);

    return back()->with('success', 'Talaba guruhdan muvaffaqiyatli o‘chirildi');    

}

}