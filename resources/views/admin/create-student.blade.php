<x-layouts.admin>

    <div class="w-full h-screen overflow-y-auto p-6">
        {!! ToastMagic::scripts() !!}
        {!! ToastMagic::styles() !!}

        <!-- Toast xabarlari -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    ToastMagic.success("{{ session('success') }}");
                });
            </script>
        @endif

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Talabalar</h1>
                <p class="text-gray-500 mt-1">Barcha talabalarni boshqaring</p>
            </div>
            <button onclick="openCreateModal()" class="bg-[#4F46E5] hover:bg-[#4338CA] text-white px-5 py-2.5 rounded-lg font-medium flex items-center gap-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Talaba qo'shish
            </button>
        </div>

        <!-- QIDIRUV PANELI -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span class="text-gray-700 font-medium">Talaba qidirish...</span>
            </div>
            <input 
                type="text" 
                id="liveSearch" 
                placeholder="Ism, familiya, email, telefon yoki Student ID bo'yicha qidiring..." 
                class="w-full px-4 py-3 border-0 bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:bg-white transition-all"
                autocomplete="off"
            >
            <div id="searchInfo" class="mt-2 text-sm text-gray-500 pl-1"></div>
        </div>

        <!-- JADVAL KONTEYNERI -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- JADVAL -->
            <div class="overflow-x-auto">
                <table class="w-full" id="studentsTable">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 text-left text-gray-600 font-medium">№</th>
                            <th class="p-4 text-left text-gray-600 font-medium">Student ID</th>
                            <th class="p-4 text-left text-gray-600 font-medium">Ism</th>
                            <th class="p-4 text-left text-gray-600 font-medium">Familiya</th>
                            <th class="p-4 text-left text-gray-600 font-medium">Telefon</th>
                            <th class="p-4 text-left text-gray-600 font-medium">Email</th>
                            <th class="p-4 text-left text-gray-600 font-medium">Amallar</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody">
                        @foreach($students as $index => $student)
                        @php
                            // Ism va familiyani ajratish
                            $nameParts = explode(' ', $student->fullname);
                            $firstName = $nameParts[0] ?? $student->fullname;
                            $lastName = $nameParts[1] ?? (isset($nameParts[1]) ? $nameParts[1] : '-');
                            // Agar 3 qism bo'lsa (Otasining ismi)
                            if(count($nameParts) >= 3) {
                                $lastName = $nameParts[2];
                            }
                        @endphp
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-gray-700">{{ $index + 1 }}</td>
                            <td class="p-4 font-medium text-gray-800">{{ $student->student_id }}</td>
                            <td class="p-4 text-gray-800">{{ $firstName }}</td>
                            <td class="p-4 text-gray-700">{{ $lastName }}</td>
                            <td class="p-4 text-gray-700">{{ $student->phone_number ?? '-' }}</td>
                            <td class="p-4 text-gray-700">{{ $student->email }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <button type="button" class="text-[#4F46E5] hover:text-[#4338CA] transition-colors p-1.5 rounded hover:bg-blue-50"
                                        onclick="openEditModal('{{ $student->id }}','{{ $student->student_id }}','{{ addslashes($student->fullname) }}','{{ $student->email }}','{{ $student->phone_number ?? '' }}')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.delete.student', $student->id) }}" class="inline" 
                                          onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[#DC2626] hover:text-[#B91C1C] transition-colors p-1.5 rounded hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($students->isEmpty())
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-3">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500">Hech qanday talaba topilmadi.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- CREATE MODAL -->
<div id="createModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center z-50 p-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg">
        <!-- Modal Header -->
        <div class="border-b p-6">
            <h2 class="text-xl font-semibold text-gray-800">Yangi talaba yaratish</h2>
            <p class="text-gray-500 text-sm mt-1">Talaba ma'lumotlarini kiriting</p>
        </div>

        <!-- Modal Content -->
        <form method="POST" action="{{ route('admin.create.student.post') }}" class="p-6">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student ID *</label>
                    <input name="student_id" placeholder="Masalan: STU001" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To'liq ism *</label>
                    <input name="fullname" placeholder="Masalan: Asomiddin Nurmatov" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input name="email" placeholder="example@email.com" type="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                        <input name="phone_number" placeholder="+998 90 123 45 67" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Parol *</label>
                        <input type="password" name="password" placeholder="••••••••" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Parolni tasdiqlash *</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                <button type="button" onclick="closeCreateModal()" 
                        class="px-5 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Bekor qilish
                </button>
                <button type="submit" 
                        class="bg-[#4F46E5] hover:bg-[#4338CA] text-white px-5 py-2.5 rounded-lg font-medium transition-colors">
                    Yaratish
                </button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center z-50 p-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg">
        <!-- Modal Header -->
        <div class="border-b p-6">
            <h2 class="text-xl font-semibold text-gray-800">Talabani tahrirlash</h2>
            <p class="text-gray-500 text-sm mt-1">Talaba ma'lumotlarini o'zgartiring</p>
        </div>

        <!-- Modal Content -->
        <form method="POST" id="editForm" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                    <input id="edit_student_id" disabled 
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To'liq ism *</label>
                    <input name="fullname" id="edit_fullname" placeholder="To'liq ism" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input name="email" id="edit_email" placeholder="Email" type="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                        <input name="phone_number" id="edit_phone" placeholder="Telefon" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#4F46E5] focus:border-transparent transition-all">
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                <button type="button" onclick="closeEditModal()" 
                        class="px-5 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Bekor qilish
                </button>
                <button type="submit" 
                        class="bg-[#4F46E5] hover:bg-[#4338CA] text-white px-5 py-2.5 rounded-lg font-medium transition-colors">
                    Yangilash
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal funksiyalari
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(id, student_id, fullname, email, phone) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('edit_student_id').value = student_id;
        document.getElementById('edit_fullname').value = fullname;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('editForm').action = `/admin/update-student/${id}`;
        document.body.style.overflow = 'hidden';
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // O'chirishni tasdiqlash
    function confirmDelete(event) {
        if (!confirm('Rostdan ham ushbu talabani o\'chirmoqchimisiz?')) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Live Search
    document.getElementById('liveSearch').addEventListener('input', function () {
        let query = this.value.toLowerCase().trim();
        let rows = document.querySelectorAll('#studentsTableBody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            if (query === '' || text.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Natija haqida ma'lumot
        let info = document.getElementById('searchInfo');
        if (query === '') {
            info.innerHTML = '';
        } else {
            info.innerHTML = `<strong>${visibleCount}</strong> ta natija topildi ("${this.value}" bo‘yicha)`;
        }
    });

    // Modal tashqarisini bosganda modalni yopish
    [document.getElementById('createModal'), document.getElementById('editModal')].forEach(modal => {
        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
        }
    });
</script>

<style>
    /* Animatsiyalar */
    #createModal, #editModal {
        animation: fadeIn 0.2s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Scrollbar styling */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

</x-layouts.admin>