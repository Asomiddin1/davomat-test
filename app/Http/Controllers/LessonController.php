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
   public function index(Request $request)
{
    // 1. Forma uchun kerakli ma'lumotlar
    $groups = Group::all();
    $subjects = Subject::all();
    $teachers = Teacher::all();

    // 2. Dars jadvallarini olish (Queryni boshlaymiz)
    $query = Lesson::with(['group', 'subject', 'teacher'])
        ->orderBy('lesson_date', 'desc') // Eng yangi sanalar yuqorida
        ->orderBy('start_time', 'asc');

    // 3. AGAR filterda guruh tanlangan bo'lsa, faqat o'shani olamiz
    if ($request->has('group_id') && $request->group_id != '') {
        $query->where('group_id', $request->group_id);
    }

    // 4. Natijani olamiz
    $schedules = $query->get();

    return view('admin.lessons.index', compact('groups', 'subjects', 'teachers', 'schedules'));
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
