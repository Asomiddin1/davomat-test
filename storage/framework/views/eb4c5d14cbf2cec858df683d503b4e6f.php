<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>


<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="flex min-h-screen bg-gray-50"
     x-data="{ openModal: false, target: '' }">

    <!-- SIDEBAR -->
    <div class="w-64 flex-shrink-0">
        <?php echo $__env->make('components.admin-components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Xabarlar</h1>
                <p class="text-gray-500 text-sm mt-1">
                    Barcha yuborilgan xabarlarni ko‘ring
                </p>
            </div>

            <!-- OPEN MODAL BUTTON -->
            <button
                @click="openModal = true"
                class="bg-[#7c83a7] hover:bg-[#6b7294]
                       text-white px-5 py-2.5 rounded-xl
                       flex items-center gap-2 transition-colors">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 rotate-45"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Xabar yuborish
            </button>
        </div>

        <!-- MESSAGES LIST (STATIC MISOL) -->
        <div class="space-y-4">

            <div class="bg-white border rounded-3xl p-6 shadow-sm">
                <h3 class="text-lg font-medium">Dars jadvali o‘zgarishi</h3>
                <p class="text-gray-400 text-sm">Guruh: AT 101-22</p>
                <p class="text-gray-600 mt-3">
                    Hurmatli talabalar, ertaga dars jadvali o‘zgardi.
                </p>
            </div>

        </div>
    </div>

    <!-- ================= MODAL ================= -->
    <div x-show="openModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <!-- BACKDROP -->
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"
             @click="openModal = false"></div>

        <!-- MODAL BODY -->
        <form
            method="POST"
            action=""
            @submit="openModal = false"
            class="relative bg-white w-full max-w-lg
                   rounded-2xl p-6 shadow-2xl">

            <?php echo csrf_field(); ?>

            <!-- MODAL HEADER -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">
                    Xabar yuborish
                </h2>
                <button type="button"
                        @click="openModal = false"
                        class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            <!-- TARGET -->
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Kimga yuborilsin?
            </label>
            <select name="target"
                    x-model="target"
                    required
                    class="w-full border rounded-xl px-4 py-2 mb-4">
                <option value="">Tanlang</option>
                <option value="student">Talabaga</option>
                <option value="group">Guruhga</option>
                <option value="all">Hammaga</option>
            </select>

            <!-- TITLE -->
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Xabar sarlavhasi
            </label>
            <input type="text"
                   name="title"
                   required
                   class="w-full border rounded-xl px-4 py-2 mb-4">

            <!-- MESSAGE -->
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Xabar matni
            </label>
            <textarea name="message"
                      rows="4"
                      required
                      class="w-full border rounded-xl px-4 py-2 mb-6"></textarea>

            <!-- SUBMIT -->
            <button type="submit"
                    class="w-full bg-[#7c83a7]
                           hover:bg-[#6b7294]
                           text-white py-2.5
                           rounded-xl transition">
                Yuborish    
            </button>

        </form>
    </div>
</div>
<?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/admin/message.blade.php ENDPATH**/ ?>