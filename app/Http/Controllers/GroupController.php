<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class GroupController extends Controller
{
    /* =======================
        GROUP LIST
    ======================== */
    public function index()
    {
        $groups = Group::all();
        return view('admin.groups.groups', compact('groups'));
    }

    /* =======================
        CREATE GROUP
    ======================== */
    public function createGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
            'type' => 'required|string|max:255',
        ]);

        Group::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => 'active', // default
        ]);

        ToastMagic::success('Yangi guruh muvaffaqiyatli yaratildi!');
        return redirect()->route('admin.groups');
    }

    /* =======================
        SHOW GROUP
    ======================== */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        $students = $group->students;
        $allStudents = Student::all();

        return view('admin.groups.group-details', compact(
            'group',
            'students',
            'allStudents'
        ));
    }

    /* =======================
        UPDATE GROUP NAME
    ======================== */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id,
        ]);

        $group->update([
            'name' => $request->name,
        ]);

        ToastMagic::success('Guruh nomi muvaffaqiyatli yangilandi');
        return back();
    }

    /* =======================
        UPDATE GROUP STATUS
    ======================== */
    public function status(Request $request, Group $group)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $group->update([
            'status' => $request->status,
        ]);

        ToastMagic::success('Guruh holati yangilandi');
        return back();
    }

    /* =======================
        DELETE GROUP
    ======================== */
    public function destroy(Group $group)
    {
        // ❗ avval pivot table tozalaymiz
        $group->students()->detach();

        $group->delete();

        ToastMagic::success('Guruh muvaffaqiyatli o‘chirildi');
        return redirect()->route('admin.groups');
    }

    /* =======================
        ADD STUDENT TO GROUP
    ======================== */
    public function addStudent(Request $request)
    {
        $request->validate([
            'group_id'   => 'required|exists:groups,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $group = Group::findOrFail($request->group_id);

        if ($group->students()
            ->wherePivot('student_id', $request->student_id)
            ->exists()) {

            ToastMagic::error('Bu talaba allaqachon guruhda mavjud');
            return back();
        }

        $group->students()->attach($request->student_id);

        ToastMagic::success('Talaba guruhga qo‘shildi');
        return back();
    }

    public function removeStudent($group_id, $student_id)
    {
        $group = Group::findOrFail($group_id);
        $group->students()->detach($student_id);

        ToastMagic::success('Talaba guruhdan o‘chirildi');
        return back();
    }
}
