<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Jadval sahifasi
     */
    public function showShedulce()
    {
        return view('admin.shedulce', [
            'groups'    => Group::all(),
            'teachers'  => Teacher::all(),
            'subjects'  => Subject::all(),
            'schedules' => Schedule::with(['group','teacher','subject'])
                                ->orderBy('lesson_date')
                                ->orderBy('start_time')
                                ->get()
        ]);
    }

    /**
     * Yangi dars qo‘shish
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id'    => 'required|exists:groups,id',
            'subject_id'  => 'required|exists:subjects,id',
            'teacher_id'  => 'required|exists:teachers,id',
            'lesson_date' => 'required|date',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
            'room'        => 'required|string|max:20',
        ]);

        Schedule::create($request->all());

        return redirect()->back()->with('success', 'Dars jadvali qo‘shildi');
    }

    /**
     * Tahrirlash uchun bitta darsni olish (AJAX / modal uchun)
     */
    public function edit($id)
    {
        return Schedule::with(['group','teacher','subject'])->findOrFail($id);
    }

    /**
     * Darsni yangilash
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'group_id'    => 'required|exists:groups,id',
            'subject_id'  => 'required|exists:subjects,id',
            'teacher_id'  => 'required|exists:teachers,id',
            'lesson_date' => 'required|date',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
            'room'        => 'required|string|max:20',
        ]);

        $schedule->update($request->all());

        return redirect()->back()->with('success', 'Dars jadvali yangilandi');
    }

    /**
     * Darsni o‘chirish
     */
    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Dars jadvali o‘chirildi');
    }

    /**
     * Bugungi darslar
     */
    public function today()
    {
        return Schedule::with(['group','teacher','subject'])
            ->whereDate('lesson_date', today())
            ->get();
    }

    /**
     * Guruh bo‘yicha jadval
     */
    public function byGroup($groupId)
    {
        return Schedule::with(['group','teacher','subject'])
            ->where('group_id', $groupId)
            ->get();
    }
}
