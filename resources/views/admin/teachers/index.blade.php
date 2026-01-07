<x-layouts.admin>
    {{-- Content area --}}
    <div class="flex-1 p-6 md:p-8">

        <!-- Page title -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Teachers</h1>
        </div>

        <!-- Create teacher form -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <form method="POST" action="{{ route('teachers.store') }}" class="flex gap-4">
                @csrf
                <input 
                    type="text" 
                    name="full_name" 
                    placeholder="Teacher name" 
                    required 
                    class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-blue-500"
                >
                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700"
                >
                    Qo‘shish
                </button>
            </form>
        </div>

        <!-- Teachers list -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3 text-left">#</th>
                        <th class="border p-3 text-left">Name</th>
                        <th class="border p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-3">{{ $loop->iteration }}</td>
                            <td class="border p-3">{{ $teacher->full_name }}</td>
                            <td class="border p-3 text-center">
                                <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}" onsubmit="return confirm('O‘chirilsinmi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        O‘chirish
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border p-4 text-center text-gray-500">
                                Hech qanday teacher topilmadi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-layouts.admin>
