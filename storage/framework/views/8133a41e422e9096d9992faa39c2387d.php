<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davomat Tizimi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Scrollbar dizayni (ixtiyoriy) */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div id="overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

    <aside id="sidebar" class="fixed top-0 left-0 z-50 w-64 h-screen bg-white shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
               <?php echo $__env->make('components.admin-components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    <nav class="sticky top-0 z-30 flex items-center justify-between h-16 px-4 sm:px-6 bg-white shadow-sm border-b border-gray-100">
        
        <div class="flex items-center gap-4">
            <button id="open-sidebar" class="p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
             </button>
       <div class=" py-4 border-b border-gray-200">
      <a href="/" class="flex items-center space-x-2">
        <img class="w-10" src="https://portfolio.jdu.uz/assets/logo-CTSg48Ew.png" alt="logo" />
        <h1 class="text-xl font-bold text-blue-600">
          JDU <span class="text-blue-600 text-lg font-normal">Admin</span>
        </h1>
      </a>
    </div>
        </div>
    
        <div class="flex items-center gap-3 sm:gap-4">
            
            <button class="relative p-2 text-gray-400 hover:text-blue-600 hover:bg-gray-100 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-2 right-2 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white animate-pulse"></span>
            </button>
        </div>
    </nav>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- SIDEBAR LOGIC ---
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            function toggleSidebar(show) {
                if (show) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    // Body scrollni to'xtatish (ixtiyoriy)
                    document.body.style.overflow = 'hidden';
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            }

            if(openBtn) openBtn.addEventListener('click', () => toggleSidebar(true));
            if(closeBtn) closeBtn.addEventListener('click', () => toggleSidebar(false));
            if(overlay) overlay.addEventListener('click', () => toggleSidebar(false));

            // Klaviaturada ESC bosilganda yopish
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar(false);
                }
            });


            // --- USER DROPDOWN LOGIC ---
            const userBtn = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            if(userBtn && userDropdown) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Click sidebar yopib yubormasligi uchun
                    userDropdown.classList.toggle('hidden');
                });

                // Tashqariga bosilganda dropdownni yopish
                document.addEventListener('click', (e) => {
                    if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/components/admin-components/navbar-admin.blade.php ENDPATH**/ ?>