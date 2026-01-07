<x-layouts.admin>
    {{-- Content area --}}
    <div class="flex-1 p-4 md:p-8">
        <div class="max-w-6xl mx-auto">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-black text-gray-800">Dars jadvalini boshqarish</h1>
                    <p class="text-sm text-gray-500">Yangi darslarni qo'shish va tahrirlash bo'limi</p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Bugun</span>
                    <p class="font-bold text-gray-700">{{ now()->format('d-F, Y') }}</p>
                </div>
            </div>

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- CREATE FORM --}}
            <form action="{{ route('lessons.store') }}" method="POST"
                  class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
                @csrf

                <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="p-2 bg-blue-100 text-blue-600 rounded-lg">+</span>
                    Yangi dars kiritish
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    {{-- Group --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Guruh</label>
                        <select name="group_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <option value="" disabled selected>Guruhni tanlang</option>
                            @foreach($groups as $group) 
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subject --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Fan</label>
                        <select name="subject_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <option value="" disabled selected>Fan tanlang</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Teacher --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">O‘qituvchi</label>
                        <select name="teacher_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <option value="" disabled selected>O‘qituvchini tanlang</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Sana</label>
                        <input type="date" name="lesson_date" required
                               class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    {{-- Start --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Boshlanish</label>
                        <input type="time" name="start_time" required class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    {{-- End --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Tugash</label>
                        <input type="time" name="end_time" required class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    {{-- Room --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Xona</label>
                        <input type="text" name="room" placeholder="203" required
                               class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    <div class="flex items-end">
                        <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl">
                            Jadvalga qo‘shish
                        </button>
                    </div>
                </div>
            </form>

            {{-- TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-xs text-gray-400">Guruh</th>
                            <th class="px-6 py-4 text-xs text-gray-400">Fan / Ustoz</th>
                            <th class="px-6 py-4 text-xs text-gray-400">Vaqt / Xona</th>
                            <th class="px-6 py-4 text-xs text-gray-400 text-right">Amallar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($schedules as $schedule)
                            <tr class="border-t hover:bg-blue-50/30">
                                <td class="px-6 py-4 font-bold">{{ $schedule->group->name }}</td>

                                <td class="px-6 py-4">
                                    <div class="font-bold">{{ $schedule->subject->name }}</div>
                                    <div class="text-xs text-gray-400 italic">{{ $schedule->teacher->full_name }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                    <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 rounded">
                                        XONA {{ $schedule->room }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('lessons.destroy', $schedule->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500">O‘chirish</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layouts.admin>
