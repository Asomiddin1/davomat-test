<div x-show="openSettings" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4">

    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"
         @click="openSettings = false"></div>

    <!-- MODAL -->
    <div x-show="openSettings" x-transition
         class="relative bg-white w-full max-w-md rounded-2xl p-6 shadow-2xl">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800">Guruh sozlamalari</h2>
            <button @click="openSettings = false"
                    class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        <!-- 1️⃣ GROUP NAME UPDATE -->
        <form method="POST" action="{{ route('admin.groups.update', $group->id) }}" class="mb-4">
            @csrf
            @method('PUT')

            <label class="block text-sm font-medium text-gray-600 mb-1">
                Guruh nomi
            </label>

            <input type="text" name="name"
                   value="{{ $group->name }}"
                   class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#7D8ABC]">

            <button class="mt-3 w-full bg-[#7D8ABC] hover:bg-[#6B79A8]
                           text-white py-2 rounded-xl transition">
                Saqlash
            </button>
        </form>

        <!-- 2️⃣ STATUS -->
        <form method="POST" action="{{ route('admin.groups.status', $group->id) }}" class="mb-4">
            @csrf
            @method('PATCH')

            <label class="block text-sm font-medium text-gray-600 mb-2">
                Guruh holati
            </label>

            <select name="status"
                    class="w-full border rounded-xl px-4 py-2">
                <option value="active" {{ $group->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="inactive" {{ $group->status == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            <button class="mt-3 w-full bg-gray-800 hover:bg-gray-900
                           text-white py-2 rounded-xl transition">
                Yangilash
            </button>
        </form>

        <!-- 3️⃣ DELETE GROUP -->
        <form method="POST"
              action="{{ route('admin.groups.destroy', $group->id) }}"
              onsubmit="return confirm('Guruhni o‘chirishga ishonchingiz komilmi?')">
            @csrf
            @method('DELETE')

            <button class="w-full bg-red-500 hover:bg-red-600
                           text-white py-2 rounded-xl transition">
                Guruhni o‘chirish
            </button>
        </form>

    </div>
</div>
