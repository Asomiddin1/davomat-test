<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class LessonController extends Controller
{
    // List page
    public function index()
    {
        $schedules = Lesson::with(['group', 'teacher', 'subject'])->get();
        $groups    = Group::all();
        $teachers  = Teacher::all();
        $subjects  = Subject::all();

        return view('admin.lessons.index', compact('schedules', 'groups', 'teachers', 'subjects'));
    }

    // Create
    public function store(Request $request)
    {
        $request->validate([
            'group_id'    => 'required|exists:groups,id',
            'teacher_id'  => 'required|exists:teachers,id',
            'subject_id'  => 'required|exists:subjects,id',
            'lesson_date' => 'required|date',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
            'room'        => 'required|string|max:20',
        ]);

        Lesson::create($request->all());

        ToastMagic::success('Dars jadvali qo‘shildi');

        return redirect()->back();
    }

    // Delete
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        ToastMagic::success('Dars o‘chirildi');

        return redirect()->back();
    }
}
