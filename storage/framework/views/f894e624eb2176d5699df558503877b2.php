<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
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

            
            <form action="<?php echo e(route('lessons.store')); ?>" method="POST"
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
                            <option value="" disabled selected>Guruhni tanlang</option>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">Fan</label>
                        <select name="subject_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <option value="" disabled selected>Fan tanlang</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase">O‘qituvchi</label>
                        <select name="teacher_id" required class="w-full bg-gray-50 rounded-xl py-3">
                            <option value="" disabled selected>O‘qituvchini tanlang</option>
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
                                <td class="px-6 py-4 font-bold"><?php echo e($schedule->group->name); ?></td>

                                <td class="px-6 py-4">
                                    <div class="font-bold"><?php echo e($schedule->subject->name); ?></div>
                                    <div class="text-xs text-gray-400 italic"><?php echo e($schedule->teacher->full_name); ?></div>
                                </td>

                                <td class="px-6 py-4">
                                    <?php echo e($schedule->start_time); ?> - <?php echo e($schedule->end_time); ?>

                                    <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 rounded">
                                        XONA <?php echo e($schedule->room); ?>

                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form action="<?php echo e(route('lessons.destroy', $schedule->id)); ?>"
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/admin/lessons/index.blade.php ENDPATH**/ ?>