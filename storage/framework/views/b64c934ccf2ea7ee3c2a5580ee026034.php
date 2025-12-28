<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>


<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="flex bg-[#F1F4F9] min-h-screen font-sans">
    <main class="flex-1 p-8">

        
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <a href="<?php echo e(route('admin.groups')); ?>" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="flex">
                    <h1 class="text-xl font-semibold text-[#2D3748]"><?php echo e($group->name ?? 'Guruh nomi'); ?></h1>
                    <p class="ml-4 inline-flex px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <?php echo e($students->count()); ?> Talaba
                  </p>
                </div>
                <div>
                    <div x-data="{ openSettings: false }">
    <!-- SETTINGS BUTTON -->
    <button @click="openSettings = true"
            class="text-gray-500 hover:text-gray-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87
                  .074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125
                  1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26
                  1.431l-1.003.827c-.293.241-.438.613-.43.992v.255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26
                  1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124l-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87l-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49L2.38 14.98a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991v-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124l.22-.128c.332-.183.582-.495.644-.869l.214-1.28Z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
        </svg>
    </button>

    <!-- SETTINGS MODAL -->
    <?php echo $__env->make('admin.groups.settings-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

                </div>
            </div>

            
            <div x-data="{ showModal: false }">
                <button @click="showModal = true" class="bg-[#7D8ABC] hover:bg-[#6B79A8] text-white px-5 py-2.5 rounded-xl flex items-center gap-2 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                    Talaba qo'shish
                </button>

               
<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="showModal = false"></div>

    <div x-show="showModal" x-transition class="relative bg-white w-full max-w-md rounded-2xl p-6 shadow-2xl"
         x-data="{ search: '' }">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800">Guruhga talaba qo'shish</h2>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        
        <input type="text" placeholder="Talaba qidirish..." 
               class="w-full border border-gray-200 rounded-xl px-4 py-2 mb-4 focus:ring-2 focus:ring-[#7D8ABC] outline-none"
               x-model="search">

        
         
<div class="space-y-2 max-h-60 overflow-y-auto pr-2">
    <?php $__currentLoopData = $allStudents ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div x-show="
        '<?php echo e($student->fullname); ?>'.toLowerCase().includes(search.toLowerCase()) ||
        '<?php echo e($student->student_id); ?>'.includes(search)
    "
    class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-xl border border-transparent hover:border-gray-100 transition-all">

        <div>
            <p class="font-medium text-gray-700"><?php echo e($student->fullname); ?></p>
            <p class="text-xs text-gray-400"><?php echo e($student->email); ?></p>
        </div>

        
        <?php
            $isInGroup = $students->contains('id', $student->id); // guruhdagi talabalar kolleksiyasi
        ?>
        <form method="POST" action="<?php echo e(route('admin.groups.addStudent')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="group_id" value="<?php echo e($group->id); ?>">
            <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
            <button type="submit"
                    class="px-3 py-1 rounded-lg text-xs text-white transition-all"
                    :class="{
                        'bg-gray-300 cursor-not-allowed': <?php echo e($isInGroup ? 'true' : 'false'); ?>,
                        'bg-[#7D8ABC] hover:bg-[#6B79A8]': <?php echo e($isInGroup ? 'false' : 'true'); ?>

                    }"
                    <?php echo e($isInGroup ? 'disabled' : ''); ?>>
                Qo'shish
            </button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

    </div>
</div>

            </div>
        </div>

        
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden mt-6">
            <table class="w-full">
                <thead>
                    <tr class="bg-[#FBFBFE]">
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">№</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Familiya</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Telefon</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-[#F8F9FD] transition-colors group">
                            <td class="py-4 px-6 text-sm text-gray-600"><?php echo e($loop->iteration); ?></td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-700"><?php echo e($student->student_id); ?></td>
                            <td class="py-4 px-6 text-sm text-gray-600"><?php echo e($student->fullname); ?></td>
                            <td class="py-4 px-6 text-sm text-gray-600"><?php echo e($student->phone_number); ?></td>
                            <td class="py-4 px-6 text-sm text-gray-600"><?php echo e($student->email); ?></td>
                            <td class="py-4 px-6 text-center">
                                <form method="POST" action="<?php echo e(route('admin.remove.student.from.group', ['group_id' => $group->id, 'student_id' => $student->id])); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-[#E57373] hover:bg-red-50 p-2 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Bu guruhda talabalar yo‘q</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>
</div>
<?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/admin/groups/group-details.blade.php ENDPATH**/ ?>