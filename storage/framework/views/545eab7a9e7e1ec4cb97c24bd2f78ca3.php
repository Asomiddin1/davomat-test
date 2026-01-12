<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davomat</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/nprogress/nprogress.css">
    <style>
        #nprogress .bar { background: #2563eb; height: 3px; }
        #nprogress .peg { box-shadow: 0 0 10px #2563eb, 0 0 5px #2563eb; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="h-full overflow-hidden bg-slate-50"> 
    
    <div class="flex h-screen overflow-hidden shadow-xl custom_bg flex-col md:flex-row">
        
        <div class="block md:hidden flex-shrink-0 bg-white border-b border-gray-100 w-full">
            <?php echo $__env->make('components.student-components.navbar-student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="hidden md:flex h-full flex-shrink-0 border-r border-gray-100 bg-white">
            <?php echo $__env->make('components.student-components.sidebar-student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="flex-1 h-full overflow-y-auto overflow-x-hidden">
             <main class="min-h-full">
                <?php echo e($slot); ?>

             </main>
        </div>
        
    </div>

    <script src="https://unpkg.com/nprogress/nprogress.js"></script>
    <script>
        NProgress.start();
        window.addEventListener('load', function () {
            NProgress.done();
        });

        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!link.target && link.hostname === window.location.hostname) {
                    NProgress.start();
                }
            });
        });
    </script>
</body>
</html><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/components/layouts/app.blade.php ENDPATH**/ ?>