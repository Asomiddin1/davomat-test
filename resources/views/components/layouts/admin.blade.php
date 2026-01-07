<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    {{-- Alpine.js x-cloak stili: sahifa yuklanganda modal ko'rinib qolmasligi uchun --}}
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #7D8ABC; border-radius: 10px; }
    </style>

    {{ $styles ?? '' }}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

{{-- x-data ni body ga chiqardik, barcha ichki sahifalar modalni boshqara oladi --}}
<body class="bg-[#f8f9fa]" 
      x-data="{ 
          openCreateModal: false, 
          openAddStudentModal: false,
          searchStudent: '',
          activeFilter: 'all'
      }">

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    @include('components.admin-components.sidebar')

    {{-- Main --}}
    <main class="flex-1 h-screen overflow-y-auto custom-scrollbar">
        {{ $slot }}
    </main>
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