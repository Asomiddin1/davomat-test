<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    [x-cloak] { display: none !important; }
</style>

<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="p-8 bg-[#f8f9fa] min-h-screen">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-[#343a40]">Xabarlar</h1>
            <p class="text-gray-500 text-sm mt-1">Sizga yuborilgan xabarlar</p>
        </div>

      <div class="space-y-4">
    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div id="message-<?php echo e($msg->id); ?>"
             class="bg-white border border-gray-100 rounded-[24px] p-7 shadow-sm
                    flex justify-between items-start transition-all hover:shadow-md">

            
            <div class="flex gap-5 text-left">
                <div
                    class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0
                    <?php echo e($msg->target_type == 'student' ? 'bg-[#f0f2ff]' : 'bg-[#f5f3ff]'); ?>">
                    <?php if($msg->target_type == 'student'): ?>
                        <i data-lucide="user" class="w-6 h-6 text-[#7c83a7]"></i>
                    <?php else: ?>
                        <i data-lucide="users" class="w-6 h-6 text-[#9d72ff]"></i>
                    <?php endif; ?>
                </div>

                <div>
                    <h3 class="text-[18px] font-semibold text-[#343a40]">
                        <?php echo e($msg->title); ?>

                    </h3>

                    <p class="text-gray-500 text-[14px] mt-0.5">
                        <?php if($msg->target_type == 'all'): ?>
                            Hammaga
                        <?php elseif($msg->target_type == 'group'): ?>
                            Guruh: <?php echo e($msg->group->name ?? '-'); ?>

                        <?php elseif($msg->target_type == 'student'): ?>
                            Sizga
                        <?php endif; ?>
                    </p>

                    <p class="text-[#4a5568] mt-4 leading-relaxed text-[15px] max-w-2xl">
                        <?php echo e($msg->body); ?>

                    </p>

                    <div class="flex items-center gap-2 mt-4 text-gray-400 text-sm">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>
                            <?php echo e($msg->created_at->format('d M Y H:i')); ?>

                            · <?php echo e($msg->created_at->diffForHumans()); ?>

                        </span>
                    </div>
                </div>
            </div>

            
            <div class="flex flex-col items-end justify-between self-stretch gap-3">
                <span id="badge-<?php echo e($msg->id); ?>"
                      class="px-3 py-1 rounded-full text-[12px] font-medium
                      <?php echo e($msg->is_read ? 'bg-gray-100 text-gray-600' : 'bg-[#e7f9f3] text-[#28a745]'); ?>">
                    <?php echo e($msg->is_read ? "O‘qilgan" : "Yangi"); ?>

                </span>

                <?php if(!$msg->is_read): ?>
                    <button onclick="markAsRead(<?php echo e($msg->id); ?>)"
                            class="px-4 py-2 text-sm rounded-full
                                   bg-[#7c83a7] hover:bg-[#6b7294]
                                   text-white transition  cursor-pointer">
                        O‘qildi deb belgilash
                    </button>
                <?php endif; ?>
            </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        
        <div class="bg-white border border-gray-100 rounded-[24px] p-12
                    text-center shadow-sm">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center
                        rounded-full bg-gray-100 text-gray-400">
                <i data-lucide="mail-open" class="w-10 h-10"></i>
            </div>

            <h3 class="text-xl font-semibold text-gray-700">
                Hozircha sizda xabarlar yo‘q
            </h3>
            <p class="text-gray-500 mt-2">
                Yangi xabarlar yuborilganda shu yerda ko‘rinadi
            </p>
        </div>
    <?php endif; ?>
</div>


        <div class="mt-8">
            <?php echo e($messages->links()); ?>

        </div>
    </div>

    
    <script>
        function markAsRead(id) {
            fetch(`/student/messages/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('badge-' + id).innerText = "O‘qilgan";
                    document.getElementById('badge-' + id).className =
                        "px-3 py-1 rounded-full text-[12px] font-medium bg-gray-100 text-gray-600";

                    const btn = document.querySelector(`#message-${id} button`);
                    if (btn) btn.remove();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/student/message.blade.php ENDPATH**/ ?>