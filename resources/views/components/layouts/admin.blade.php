<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #7D8ABC; border-radius: 10px; }
    </style>

    {{ $styles ?? '' }}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#f8f9fa]" 
      x-data="{ 
          openCreateModal: false, 
          openAddStudentModal: false,
          searchStudent: '',
          activeFilter: 'all',
          sidebarOpen: false
      }">

<div class="flex min-h-screen">
    {{-- Sidebar - Desktop uchun --}}
    <div class="hidden lg:block">
        @include('components.admin-components.sidebar')
    </div>

    {{-- Mobile Sidebar - Overlay bilan --}}
    <div x-show="sidebarOpen" 
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <div x-show="sidebarOpen" 
         x-cloak
         @click.away="sidebarOpen = false"
         class="fixed inset-y-0 left-0 z-50 w-64 lg:hidden"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">
        @include('components.admin-components.sidebar')
    </div>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col min-h-screen">
        {{-- Navbar - Faqat mobile uchun --}}
        <div class="lg:hidden">
            @include('components.admin-components.navbar-admin')
        </div>

        {{-- Main Content Area --}}
        <main class="flex-1 overflow-y-auto custom-scrollbar">
            {{ $slot }}
        </main>
    </div>
</div>

{{-- Modallar uchun joy --}}
{{ $modals ?? '' }}

{{-- Sahifaga xos scriptlar --}}
{{ $scripts ?? '' }}

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>

</body>
</html>