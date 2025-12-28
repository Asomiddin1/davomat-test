<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<div class="flex custom_bg">
  <div>
    <?php echo $__env->make('components.admin-components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
      <h1>Admin Dashboard</h1>
  </div>
</div><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>