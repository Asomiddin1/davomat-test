<?php
    use App\Models\Message;
    use Illuminate\Support\Facades\Auth;

    $student = Auth::user()->student;

    // O‘QILMAGAN XABARLAR SONI
    $unreadMessagesCount = Message::where('is_read', false)
        ->where(function ($q) use ($student) {
            $q->where('target_type', 'all')
              ->orWhere(function ($q) use ($student) {
                  $q->where('target_type', 'student')
                    ->where('target_id', $student->id);
              })
              ->orWhere(function ($q) use ($student) {
                  $q->where('target_type', 'group')
                    ->whereIn('target_id', $student->groups->pluck('id'));
              });
        })
        ->count();
?>

<div class="flex h-[100vh] bg-white shadow-xl">
  <div class="flex flex-col w-64 border-r border-gray-200">

    
    <div class="px-6 py-4 border-b border-gray-200">
      <a href="/" class="flex items-center space-x-2">
        <img class="w-10" src="https://portfolio.jdu.uz/assets/logo-CTSg48Ew.png" alt="logo" />
        <h1 class="text-xl font-bold text-blue-592">
          JDU <span class="text-blue-600 text-lg font-normal">Student</span>
        </h1>
      </a>
    </div>

    
    <?php
      $menuItems = [
        ['name' => 'Dars jadvali', 'icon' => 'calendar-days', 'notification' => 0, 'link' => '/dars-jadvali'],
        ['name' => 'Talaba maʼlumotlari', 'icon' => 'user', 'notification' => 0, 'link' => '/info'],
        ['name' => 'Rejalashtirish', 'icon' => 'pencil-square', 'notification' => 0, 'link' => '/plans'],
        [
            'name' => 'Xabarlar',
            'icon' => 'envelope',
            'notification' => $unreadMessagesCount,
            'link' => '/message'
        ],
        ['name' => 'Pomidor taymer', 'icon' => 'clock', 'notification' => 0, 'link' => '/pomidor'],
      ];

      $logoutItem = ['name' => 'Chiqish', 'icon' => 'arrow-left-start-on-rectangle', 'link' => '/auth/logout'];
      $currentPath = request()->path();
    ?>

    
    <div class="flex items-center px-4 py-2 border-b border-gray-200">
      <img class="h-16 w-16 rounded-full object-cover"
           src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/logo-design-template-35b0a3e2315d19a46c046165f315b000.jpg?ts=1592240511"
           alt="" />
      <div class="ml-3">
        <p class="text-sm font-semibold text-gray-900"><?php echo e(Auth::user()->name); ?></p>
        <p class="text-xs text-gray-500">
          ID : <?php echo e(Auth::user()->student?->student_id); ?>

        </p>
      </div>
    </div>

    
    <nav class="flex-1 px-2 py-4 space-y-1">
      <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $isActive = $currentPath === ltrim($item['link'], '/');
        ?>

        <a href="<?php echo e($item['link']); ?>"
           class="group flex items-center px-4 py-2 text-sm font-medium rounded-md relative mb-2
           <?php echo e($isActive ? 'bg-blue-500 text-white' : 'text-gray-700 bg-gray-200 hover:bg-gray-300'); ?>">

          <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'heroicon-o-' . $item['icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 mr-3 '.e($isActive ? 'text-white' : 'text-gray-400 group-hover:text-gray-500').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>

          <?php echo e($item['name']); ?>


          <?php if($item['notification'] > 0): ?>
            <span class="absolute right-4 top-1/2 -translate-y-1/2
                         inline-flex items-center px-2.5 py-0.5
                         rounded-full text-xs font-semibold
                         bg-red-500 text-white">
              <?php echo e($item['notification']); ?>

            </span>
          <?php endif; ?>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    
    <div class="mt-auto px-2 py-4 mb-1">
      <a href="<?php echo e($logoutItem['link']); ?>"
         class="bg-red-600 text-white hover:bg-red-700
                group flex items-center px-4 py-2
                text-sm font-medium rounded-md w-full">
        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'heroicon-o-' . $logoutItem['icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 mr-3 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
        <?php echo e($logoutItem['name']); ?>

      </a>
    </div>

  </div>
</div>
<?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/components/student-components/sidebar-student.blade.php ENDPATH**/ ?>