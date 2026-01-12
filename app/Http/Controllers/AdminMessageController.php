<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    

    private function checkAdmin()
    {
        if(auth()->user()->role !== 'admin'){
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }
    }

   public function index()
{
    $this->checkAdmin();

    // Bu qatorni o‘zgartiring:
    $messages = Message::with(['student', 'group'])->latest()->paginate(10);

    $students = \App\Models\Student::all();
    $groups   = \App\Models\Group::all();

    return view('admin.messages', compact('messages','students','groups'));
}
    public function store(Request $request)
    {
        $this->checkAdmin();

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'target_type' => 'required|in:student,group,all',
            'target_id'   => 'nullable|integer',
        ]);

        Message::create([
            'title'       => $data['title'],
            'body'        => $data['body'],
            'sender_id'   => auth()->id(),
            'target_type' => $data['target_type'],
            'target_id'   => $data['target_type'] === 'all' ? null : $data['target_id'],
            'is_read'     => false,
        ]);
         // 4️⃣ EMAIL JO'NATISH (YANGI QISM)
        try {
            Mail::to($user->email)->send(new StudentCreatedMail($user, $rawPassword));
        } catch (\Exception $e) {
            // Agar internet yo'q bo'lsa yoki SMTP xato bersa, kod to'xtab qolmasligi uchun
            ToastMagic::error('Talaba yaratildi, lekin email ketmadi: ' . $e->getMessage());
        }

        return redirect()->back()->with('success','Xabar yuborildi');
    }

    public function destroy(Message $message)
    {
        $this->checkAdmin();
        $message->delete();
        return redirect()->back()->with('success','Xabar o‘chirildi');
    }
}
