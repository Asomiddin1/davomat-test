<div class="flex h-[100vh] bg-white shadow-xl">
  <div class="flex flex-col w-64 border-r border-gray-200">

    {{-- Header --}}
    <div class="px-6 py-4 border-b border-gray-200">
      <a href="/" class="flex items-center space-x-2">
        <img class="w-10" src="https://portfolio.jdu.uz/assets/logo-CTSg48Ew.png" alt="logo" />
        <h1 class="text-xl font-bold text-blue-600">
          JDU <span class="text-blue-600 text-lg font-normal">Admin</span>
        </h1>
      </a>
    </div>

    {{-- PHP logika --}}
    @php
      $menuItems = [
    ['name' => 'Dashboard', 'icon' => 'squares-2x2', 'notification' => 0, 'link' => '/admin'],
    ['name' => 'Gruhlar', 'icon' => 'user-group', 'notification' => 0, 'link' => '/groups'],
    ['name' => 'Adminlar', 'icon' => 'shield-check', 'notification' => 0, 'link' => '/admins'],
    ['name' => 'Xabarlar', 'icon' => 'chat-bubble-oval-left-ellipsis', 'notification' => 0, 'link' => '/admin-message'],
    ['name' => 'Talaba yaratish', 'icon' => 'user-plus', 'notification' => 0, 'link' => '/create-student'],
      ];

      $logoutItem = ['name' => 'Chiqish', 'icon' => 'arrow-left-start-on-rectangle', 'link' => '/auth/logout'];
      $currentPath = request()->path();
    @endphp

    {{-- User Profile --}}
    <div class="flex items-center px-4 py-2 border-b border-gray-200">
      <img class="h-16 w-16 rounded-full object-cover" src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/logo-design-template-35b0a3e2315d19a46c046165f315b000.jpg?ts=1592240511" alt="" />
      <div class="ml-3">
        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }} Qarshiyev</p>
        <p class="text-xs text-gray-500">ID : 2312136</p>
      </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-2 py-4 space-y-1">
      @foreach ($menuItems as $item)
        @php
          $isActive = $currentPath === ltrim($item['link'], '/');
        @endphp
        <a href="{{ $item['link'] }}"
           class="group flex items-center px-4 py-2 text-sm font-medium rounded-md relative mb-2
           {{ $isActive ? 'bg-blue-500 text-white' : 'text-gray-700 bg-gray-200 hover:bg-gray-300' }}">
           
          <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-6 h-6 mr-3 {{ $isActive ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}" />

          {{ $item['name'] }}

          @if ($item['notification'] > 0)
            <span class="absolute right-4 top-1/2 -translate-y-1/2 ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white">
              {{ $item['notification'] }}
            </span>
          @endif
        </a>
      @endforeach
    </nav>

    {{-- Logout --}}
    <div class="mt-auto px-2 py-4 mb-1">
     <a href="{{ $logoutItem['link'] }}"
   class="bg-red-600 text-white hover:bg-red-700 group flex items-center px-4 py-2 text-sm font-medium rounded-md relative w-full">
    <x-dynamic-component :component="'heroicon-o-' . $logoutItem['icon']" class="w-6 h-6 mr-3 text-white" />
   {{ $logoutItem['name'] }}
      </a>
    </div>
  </div>
</div>
