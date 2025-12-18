@vite(['resources/css/app.css', 'resources/js/app.js'])
{!! ToastMagic::styles() !!}

<div class="flex custom_bg">
    @include('components.admin-components.sidebar')

    <div class="w-full h-screen overflow-y-scroll p-10">
        {!! ToastMagic::scripts() !!}

        <!-- Toast xabarlari -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    ToastMagic.success("{{ session('success') }}");
                });
            </script>
        @endif

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Talabalar ro‘yxati</h1>
            <button onclick="openCreateModal()" class="bg-[#6A64F1] text-white px-6 py-2 rounded-md">+ Talaba qo‘shish</button>
        </div>

        <!-- QIDIRUV (Live Search - tugmasiz, yozilishi bilan ishlaydi) -->
        <div class="mb-6">
            <input 
                type="text" 
                id="liveSearch" 
                placeholder="Ism, email, telefon yoki Student ID bo‘yicha qidiring..." 
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6A64F1]"
                autocomplete="off"
            >
            <div id="searchInfo" class="mt-2 text-sm text-gray-600"></div>
        </div>

        <!-- JADVAL -->
        <table class="w-full border-collapse bg-white shadow rounded-lg" id="studentsTable">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Student ID</th>
                    <th class="p-3">Ism</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Telefon</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
                @foreach($students as $student)
                <tr class="border-t">
                    <td class="p-3">{{ $student->student_id }}</td>
                    <td class="p-3">{{ $student->fullname }}</td>
                    <td class="p-3">{{ $student->email }}</td>
                    <td class="p-3">{{ $student->phone_number ?? '-' }}</td>
                    <td class="p-3 flex gap-2">
                        <button type="button" class="text-blue-600"
                            onclick="openEditModal('{{ $student->id }}','{{ $student->student_id }}','{{ addslashes($student->fullname) }}','{{ $student->email }}','{{ $student->phone_number ?? '' }}')">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.delete.student', $student->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Rostdan ham o‘chirmoqchimisiz?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($students->isEmpty())
            <p class="text-center text-gray-500 mt-6">Hech qanday talaba topilmadi.</p>
        @endif
    </div>
</div>

<!-- CREATE MODAL -->
<div id="createModal" class="hidden fixed inset-0 bg-black/40 flex justify-center items-center">
    <div class="bg-white w-[500px] rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Talaba qo‘shish</h2>
        <form method="POST" action="{{ route('admin.create.student.post') }}">
            @csrf
            <input name="student_id" placeholder="Student ID" class="input" required>
            <input name="fullname" placeholder="To‘liq ism" class="input" required>
            <input name="email" placeholder="Email" class="input" required>
            <input name="phone_number" placeholder="Telefon" class="input">
            <input type="password" name="password" placeholder="Parol" class="input" required>
            <input type="password" name="password_confirmation" placeholder="Parolni tasdiqlang" class="input" required>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeCreateModal()">Bekor</button>
                <button class="bg-[#6A64F1] text-white px-4 py-2 rounded">Saqlash</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="hidden fixed inset-0 bg-black/40 flex justify-center items-center">
    <div class="bg-white w-[500px] rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Talabani tahrirlash</h2>
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <input id="edit_student_id" disabled class="input bg-gray-100">
            <input name="fullname" id="edit_fullname" class="input" placeholder="To‘liq ism" required>
            <input name="email" id="edit_email" class="input" placeholder="Email" required>
            <input name="phone_number" id="edit_phone" class="input" placeholder="Telefon">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeEditModal()">Bekor</button>
                <button class="bg-[#6A64F1] text-white px-4 py-2 rounded">Yangilash</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal funksiyalari (oldingi kabi qoldi)
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(id, student_id, fullname, email, phone) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('edit_student_id').value = student_id;
        document.getElementById('edit_fullname').value = fullname;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('editForm').action = `/admin/update-student/${id}`;
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Live Search - tugmasiz, yozilishi bilan filtrlaydi
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
</script>

<style>
.input {
    width:100%;
    margin-bottom:10px;
    padding:10px;
    border:1px solid #ddd;
    border-radius:6px;
}
</style>