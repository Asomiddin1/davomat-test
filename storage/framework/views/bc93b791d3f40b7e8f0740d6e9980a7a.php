<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davomat</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="flex h-full shadow-xl custom_bg">
        <div>
            <?php echo $__env->make('components.student-components.sidebar-student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div>
             <div><?php echo e($slot); ?></div>
        </div>
    </div>
</body>
</html><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/components/layout.blade.php ENDPATH**/ ?>