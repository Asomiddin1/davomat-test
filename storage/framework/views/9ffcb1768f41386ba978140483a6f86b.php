<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

<div class="flex min-h-screen bg-[#F3F4F6]">
    <div>
        <?php echo $__env->make('components.admin-components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="flex-1 p-4 md:p-8">
        <div class="max-w-6xl mx-auto">

            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-black text-gray-800">Dars jadvalini boshqarish</h1>
                    <p class="text-sm text-gray-500">Yangi darslarni qo'shish va tahrirlash bo'limi</p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Bugun</span>
                    <p class="font-bold text-gray-700"><?php echo e(now()->format('d-F, Y')); ?></p>
                </div>
            </div>

            
            <?php if(session('success')): ?>
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-xl">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <form action="<?php echo e(url('/admin/schedule')); ?>" method="POST"
                  class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
                <?php echo csrf_field(); ?>

                <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="p-2 bg-blue-100 text-blue-600 rounded-lg">+</span>
                    Yangi dars kiritish
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Guruh</label>
                        <select name="group_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Fan</label>
                        <select name="subject_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">O‘qituvchi</label>
                        <select name="teacher_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->full_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Sana</label>
                        <input type="date" name="lesson_date" required
                               class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Boshlanish</label>
                        <input type="time" name="start_time" required class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Tugash</label>
                        <input type="time" name="end_time" required class="w-full bg-gray-50 rounded-xl py-3">
                    </div>

                    
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
                        <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t hover:bg-blue-50/30">
                                <td class="px-6 py-4 font-bold">
                                    <?php echo e($schedule->group->name); ?>

                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold"><?php echo e($schedule->subject->name); ?></div>
                                    <div class="text-xs text-gray-400 italic">
                                        <?php echo e($schedule->teacher->full_name); ?>

                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <?php echo e($schedule->start_time); ?> - <?php echo e($schedule->end_time); ?>

                                    <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 rounded">
                                        XONA <?php echo e($schedule->room); ?>

                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form action="<?php echo e(url('/admin/schedule/'.$schedule->id)); ?>"
                                          method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="text-red-500">O‘chirish</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/admin/shedulce.blade.php ENDPATH**/ ?>