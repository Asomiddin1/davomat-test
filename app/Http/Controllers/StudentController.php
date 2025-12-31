<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class StudentController extends Controller
{
    public function studentInfo()
    {
        return view('student.student-info');
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
        $user = auth()->user();
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
     * ✅ Mark message as read (AJAX)
     */
    public function markAsRead(Message $message)
    {
        $user = auth()->user();
        $student = $user->student;

        $studentId = $student->id;
        $groupIds  = $student->groups->pluck('id')->toArray();

        $isRecipient =
            $message->target_type === 'all' ||
            ($message->target_type === 'student' && $message->target_id == $studentId) ||
            ($message->target_type === 'group' && in_array($message->target_id, $groupIds));

        if ($isRecipient && !$message->is_read) {
            $message->update([
                'is_read' => true,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function pomidor()
    {
        return view('student.pomidor');
    }
}
