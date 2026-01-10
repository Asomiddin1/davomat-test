<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Lesson;

class StudentController extends Controller
{
   public function studentInfo()
{
    $student = auth()->user()->student()->with('groups')->first();

    if (!$student) {
        return redirect()->back()->with('error', 'Talaba ma’lumotlari topilmadi.');
    }

    return view('student.student-info', compact('student'));
}

    public function plans()
    {
        return view('student.plans');
    }

    /**
     * 📩 Student message page
     */
    public function message()
    {
        $user = Auth::user();
        $student = $user->student;

        $studentId = $student->id;
        $groupIds  = $student->groups->pluck('id');

        $messages = Message::where(function ($q) use ($studentId, $groupIds) {
            $q->where('target_type', 'all')
              ->orWhere(function ($q) use ($studentId) {
                  $q->where('target_type', 'student')
                    ->where('target_id', $studentId);
              })
              ->orWhere(function ($q) use ($groupIds) {
                  $q->where('target_type', 'group')
                    ->whereIn('target_id', $groupIds);
              });
        })
        ->latest()
        ->paginate(10);

        return view('student.message', compact('messages'));
    }

    /**
     * ✅ Mark message as read
     */
    public function markAsRead(Message $message)
    {
        $student = Auth::user()->student;

        $studentId = $student->id;
        $groupIds  = $student->groups->pluck('id')->toArray();

        $isRecipient =
            $message->target_type === 'all' ||
            ($message->target_type === 'student' && $message->target_id == $studentId) ||
            ($message->target_type === 'group' && in_array($message->target_id, $groupIds));

        if ($isRecipient && !$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    public function pomidor()
    {
        return view('student.pomidor');
    }

    /**
     * 📅 STUDENT DARS JADVALI
     */
 public function lessons(Request $request)
{
    $user = Auth::user();
    $student = $user->student;

    // 1. O'zbekcha lotin alifbosini o'rnatish
    \Carbon\Carbon::setLocale('uz-latn'); 

    $date = $request->get('date', now()->format('Y-m-d'));
    $selectedDate = \Carbon\Carbon::parse($date);

    // 2. Haftani dushanbadan boshlab hisoblash
    $startOfWeek = $selectedDate->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
    
    $weekDays = [];
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = $startOfWeek->copy()->addDays($i);
    }

    $groupIds = $student->groups->pluck('id')->toArray();

    $lessons = Lesson::with(['teacher', 'subject', 'group'])
        ->whereIn('group_id', $groupIds)
        ->whereDate('lesson_date', $selectedDate)
        ->orderBy('start_time')
        ->get();

    return view('student.welcome', compact('lessons', 'weekDays', 'selectedDate'));
}
}
