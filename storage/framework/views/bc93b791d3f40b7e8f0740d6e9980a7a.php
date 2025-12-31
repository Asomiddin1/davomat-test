<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davomat</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/nprogress/nprogress.css">
    <style>
  #nprogress .bar {
    background: #2563eb; /* blue-600 */
    height: 3px;
  }

  #nprogress .peg {
    box-shadow: 0 0 10px #2563eb, 0 0 5px #2563eb;
  }
</style>

</head>
<body>
    <div class="flex h-full shadow-xl custom_bg">
        <div>
            <?php echo $__env->make('components.student-components.sidebar-student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="w-full">
             <div><?php echo e($slot); ?></div>
        </div>
    </div>
  <script src="https://unpkg.com/nprogress/nprogress.js"></script>

    <script>
  // Sahifa yuklana boshlaganda
  NProgress.start();

  // Sahifa to‘liq yuklanganda
  window.addEventListener('load', function () {
    NProgress.done();
  });

  // Link bosilganda (page navigation)
  document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      NProgress.start();
    });
  });
</script>

</body>
</html><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/components/layout.blade.php ENDPATH**/ ?>