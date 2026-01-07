























<x-layouts.admin>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    [x-cloak] { display: none !important; }

    /* Scrollbar styling for content */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #7c83a7; }
</style>

<div class="flex min-h-screen bg-[#f8f9fa]" 
     x-data="{ 
        openModal: false, 
        deleteModal: false, 
        deleteUrl: '', 
        target: '', 
        target_id: '', 
        target_name: '' 
     }">
    <!-- CONTENT -->
    <div class="flex-1 h-screen overflow-y-auto p-8 custom-scrollbar">

        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-[#343a40]">Xabarlar</h1>
                <p class="text-gray-500 text-sm mt-1">Barcha yuborilgan xabarlarni ko'ring</p>
            </div>
            <button @click="openModal = true; target = ''; target_id = ''; target_name = '';"
                    class="bg-[#7c83a7] hover:bg-[#6b7294] text-white px-6 py-2.5 rounded-xl flex items-center gap-2 transition-all shadow-sm">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span class="font-medium text-[15px]">Xabar yuborish</span>
            </button>
        </div>

        <div class="space-y-4">
            @foreach($messages as $msg)
                <div class="bg-white border border-gray-100 rounded-[24px] p-7 shadow-sm flex justify-between items-start transition-all hover:shadow-md">
                    <div class="flex gap-5 text-left">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 {{ $msg->target_type == 'student' ? 'bg-[#f0f2ff]' : 'bg-[#f5f3ff]' }}">
                            @if($msg->target_type == 'student')
                                <i data-lucide="user" class="w-6 h-6 text-[#7c83a7]"></i>
                            @else
                                <i data-lucide="users" class="w-6 h-6 text-[#9d72ff]"></i>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-[18px] font-semibold text-[#343a40]">{{ $msg->title }}</h3>
                            <p class="text-gray-500 text-[14px] mt-0.5">
                                @if($msg->target_type == 'all')
                                    Hammaga
                                @elseif($msg->target_type == 'group')
                                    Guruh: {{ $msg->group->name ?? '-' }}
                                @elseif($msg->target_type == 'student')
                                    Talaba: {{ $msg->student->fullname ?? '-' }}
                                @endif
                            </p>
                            <p class="text-[#4a5568] mt-4 leading-relaxed text-[15px] max-w-2xl">{{ $msg->body }}</p>
                            
                            <div class="flex items-center gap-2 mt-4 text-gray-400 text-sm">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span>
                                    {{ $msg->created_at ? $msg->created_at->format('d M Y H:i') . ' · ' . $msg->created_at->diffForHumans() : now()->format('d M Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end justify-between self-stretch">
                        <span class="px-3 py-1 rounded-full text-[12px] font-medium {{ $msg->is_read ? 'bg-gray-100 text-gray-600' : 'bg-[#e7f9f3] text-[#28a745]' }}">
                            {{ $msg->is_read ? "O'qilgan" : "Yetkazilgan" }}
                        </span>

                        <button @click="deleteModal = true; deleteUrl = '{{ route('admin.messages.destroy', $msg->id) }}'"
                                class="text-gray-300 hover:text-red-500 transition-colors p-2">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @forelse($messages as $msg)
            {{-- sizning card --}}
        @empty
            <div class="bg-white border border-gray-100 rounded-[24px] p-12
                        text-center shadow-sm">
                <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center
                            rounded-full bg-gray-100 text-gray-400">
                    <i data-lucide="mail-x" class="w-10 h-10"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-700">
                    Hozircha xabarlar yo‘q
                </h3>
                <p class="text-gray-500 mt-2">
                    Yangi xabar yuborilganda shu yerda ko‘rinadi
                </p>
            </div>
        @endforelse

        <div class="mt-8">
            {{ $messages->links() }}
        </div>
    </div>

    <!-- MODAL FORM (Yuborish) -->
    <div x-show="openModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="openModal = false"></div>
        <form method="POST" action="{{ route('admin.messages.store') }}" 
              class="relative bg-white w-full max-w-lg rounded-[28px] p-8 shadow-2xl">
            @csrf
            <input type="hidden" name="target_id" x-model="target_id">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Yangi xabar</h2>
                <button type="button" @click="openModal = false" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Kimga yuborilsin?</label>
                    <select name="target_type" x-model="target" required 
                            class="w-full border-gray-200 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7c83a7] outline-none bg-white">
                        <option value="">Tanlang</option>
                        <option value="student">Talabaga</option>
                        <option value="group">Guruhga</option>
                        <option value="all">Hammaga</option>
                    </select>
                </div>

                <template x-if="target === 'student'">
                    <div class="relative" x-data="{ 
                        search: '', 
                        showList: false,
                        students: [
                            @foreach($students as $student)
                                { id: '{{ $student->id }}', name: '{{ $student->fullname }}' },
                            @endforeach
                        ],
                        get filtered() {
                            return this.students.filter(s => s.name.toLowerCase().includes(this.search.toLowerCase()))
                        }
                    }">
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">Talabani qidiring</label>
                        <div class="relative">
                            <input type="text" x-model="search" @focus="showList = true" @click.away="showList = false"
                                   placeholder="Ism sharifini kiriting..." 
                                   class="w-full border-gray-200 border rounded-xl pl-10 pr-4 py-3 focus:ring-2 focus:ring-[#7c83a7] outline-none transition-all">
                            <i data-lucide="search" class="absolute left-3 top-3.5 w-5 h-5 text-gray-400"></i>
                        </div>

                        <div x-show="showList && filtered.length > 0" 
                             class="absolute z-10 w-full mt-1 bg-white border border-gray-100 rounded-xl shadow-xl max-h-48 overflow-y-auto custom-scrollbar">
                            <template x-for="item in filtered" :key="item.id">
                                <div @click="target_id = item.id; target_name = item.name; search = item.name; showList = false"
                                     class="px-4 py-3 hover:bg-indigo-50 cursor-pointer text-gray-700 flex justify-between items-center border-b border-gray-50 last:border-none">
                                    <span x-text="item.name"></span>
                                    <i data-lucide="check" class="w-4 h-4 text-green-500" x-show="target_id === item.id"></i>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="target === 'group'">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">Guruhni tanlang</label>
                        <select name="target_id" required 
                                class="w-full border-gray-200 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7c83a7] outline-none">
                            <option value="">Tanlang...</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </template>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Xabar sarlavhasi</label>
                    <input type="text" name="title" required class="w-full border-gray-200 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7c83a7] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Xabar matni</label>
                    <textarea name="body" rows="4" required class="w-full border-gray-200 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7c83a7] outline-none resize-none"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#7c83a7] hover:bg-[#6b7294] text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-indigo-100">
                    Yuborish
                </button>
            </div>
        </form>
    </div>

    <!-- DELETE MODAL -->
    <div x-show="deleteModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="deleteModal = false"></div>
        <div class="relative bg-white w-full max-w-sm rounded-[24px] p-8 shadow-2xl text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500">
                <i data-lucide="alert-circle" class="w-10 h-10"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">O'chirishni tasdiqlang</h2>
            <p class="text-gray-500 mb-8">Bu xabarni o'chirmoqchimisiz? Bu amalni ortga qaytarib bo'lmaydi.</p>
            <div class="flex gap-3">
                <button @click="deleteModal = false" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium">Bekor qilish</button>
                <form :action="deleteUrl" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium shadow-lg shadow-red-100">O'chirish</button>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

</x-layouts.admin>