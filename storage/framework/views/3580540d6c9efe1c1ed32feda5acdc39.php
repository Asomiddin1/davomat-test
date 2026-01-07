<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Admin Panel'); ?></title>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #7D8ABC; border-radius: 10px; }
    </style>

    <?php echo e($styles ?? ''); ?>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>


<body class="bg-[#f8f9fa]" 
      x-data="{ 
          openCreateModal: false, 
          openAddStudentModal: false,
          searchStudent: '',
          activeFilter: 'all'
      }">

<div class="flex min-h-screen">
    
    <?php echo $__env->make('components.admin-components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="flex-1 h-screen overflow-y-auto custom-scrollbar">
        <?php echo e($slot); ?>

    </main>
</div>


<?php echo e($modals ?? ''); ?>



<?php echo e($scripts ?? ''); ?>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>

</body>
</html><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/components/layouts/admin.blade.php ENDPATH**/ ?>