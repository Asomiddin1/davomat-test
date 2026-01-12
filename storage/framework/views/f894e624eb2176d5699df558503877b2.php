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
        <div class="max-w-7xl mx-auto">

            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-black text-gray-800">Dars jadvalini boshqarish</h1>
                    <p class="text-sm text-gray-500">Yangi darslarni qo'shish va tahrirlash bo'limi</p>
                </div>
                <div class="text-left md:text-right w-full md:w-auto bg-gray-50 md:bg-transparent p-3 md:p-0 rounded-xl">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block">Bugun</span>
                    <p class="font-bold text-gray-700 capitalize">
                        <?php echo e(now()->locale('uz')->translatedFormat('d-F, Y')); ?>

                    </p>
                </div>
            </div>

            
            <?php if(session('success')): ?>
                <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <form action="<?php echo e(route('lessons.store')); ?>" method="POST"
                  class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5 md:p-8 mb-8">
                <?php echo csrf_field(); ?>

                <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-lg text-xl font-bold">+</span>
                    Yangi dars kiritish
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Guruh</label>
                        <select name="group_id" required class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                            <option value="" disabled selected>Guruhni tanlang</option>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Fan</label>
                        <select name="subject_id" required class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                            <option value="" disabled selected>Fan tanlang</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">O‘qituvchi</label>
                        <select name="teacher_id" required class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                            <option value="" disabled selected>O‘qituvchini tanlang</option>
                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->full_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Sana</label>
                        <input type="date" name="lesson_date" required
                               class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Boshlanish</label>
                        <input type="time" name="start_time" required class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Tugash</label>
                        <input type="time" name="end_time" required class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                    </div>

                    
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Xona</label>
                        <input type="text" name="room" placeholder="203" required
                               class="w-full bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white rounded-xl py-3 px-4 outline-none transition">
                    </div>

                    
                    <div class="flex items-end">
                        <button class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 transition text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-200">
                            Jadvalga qo‘shish
                        </button>
                    </div>
                </div>
            </form>


            
            
            
            <div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-4 gap-4 px-1">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Darslar ro‘yxati
                </h3>
                
                <form method="GET" action="<?php echo e(url()->current()); ?>" class="flex items-center gap-2 w-full md:w-auto">
                    
                    <div class="relative w-full md:w-64">
                        <select name="group_id" 
                                onchange="this.form.submit()" 
                                class="w-full bg-white border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none shadow-sm cursor-pointer">
                            <option value="">Barcha guruhlar</option>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>" <?php echo e(request('group_id') == $group->id ? 'selected' : ''); ?>>
                                    <?php echo e($group->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <?php if(request('group_id')): ?>
                        <a href="<?php echo e(url()->current()); ?>" 
                           class="flex items-center justify-center w-10 h-10 bg-red-50 text-red-500 hover:bg-red-100 rounded-xl transition border border-red-100" 
                           title="Filterni tozalash">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            


            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px] md:min-w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-4 md:px-6 py-4 text-left text-xs text-gray-400 font-bold uppercase whitespace-nowrap">Guruh</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs text-gray-400 font-bold uppercase whitespace-nowrap">Fan / O‘qituvchi</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs text-gray-400 font-bold uppercase whitespace-nowrap">Sana</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs text-gray-400 font-bold uppercase whitespace-nowrap">Vaqt / Xona</th>
                                <th class="px-4 md:px-6 py-4 text-right text-xs text-gray-400 font-bold uppercase whitespace-nowrap">Amallar</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-blue-50/50 transition duration-150 group">
                                    
                                    <td class="px-4 md:px-6 py-4 font-bold text-gray-700 whitespace-nowrap">
                                        <?php echo e($schedule->group->name); ?>

                                    </td>

                                    
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-800"><?php echo e($schedule->subject->name); ?></div>
                                        <div class="text-xs text-gray-500 italic">
                                            <?php echo e($schedule->teacher->full_name); ?>

                                        </div>
                                    </td>

                                    
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-700">
                                            <?php echo e(\Carbon\Carbon::parse($schedule->lesson_date)->format('d.m.Y')); ?>

                                        </div>
                                        <div class="text-xs text-gray-500 capitalize">
                                            <?php echo e(\Carbon\Carbon::parse($schedule->lesson_date)->locale('uz')->translatedFormat('l')); ?>

                                        </div>
                                    </td>

                                    
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700 font-medium">
                                            <?php echo e(\Carbon\Carbon::parse($schedule->start_time)->format('H:i')); ?> - 
                                            <?php echo e(\Carbon\Carbon::parse($schedule->end_time)->format('H:i')); ?>

                                        </div>
                                        <span class="inline-block mt-1 text-[10px] font-bold bg-blue-100 text-blue-600 px-2 py-0.5 rounded border border-blue-200">
                                            <?php echo e($schedule->room); ?>-XONA
                                        </span>
                                    </td>

                                    
                                    <td class="px-4 md:px-6 py-4 text-right whitespace-nowrap">
                                        <form action="<?php echo e(route('lessons.destroy', $schedule->id)); ?>"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Rostdan ham ushbu darsni o‘chirmoqchimisiz?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-400 hover:text-red-600 font-medium text-sm transition p-2 hover:bg-red-50 rounded-lg">
                                                O‘chirish
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                
                <?php if($schedules->isEmpty()): ?>
                    <div class="p-8 text-center flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                            
                            <?php if(request('group_id')): ?>
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            <?php else: ?>
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <?php endif; ?>
                        </div>
                        <p class="text-gray-500 font-medium">
                            <?php if(request('group_id')): ?>
                                Ushbu guruh uchun darslar topilmadi.
                            <?php else: ?>
                                Hozircha dars jadvali kiritilmagan.
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endif; ?>
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
<?php endif; ?><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/admin/lessons/index.blade.php ENDPATH**/ ?>