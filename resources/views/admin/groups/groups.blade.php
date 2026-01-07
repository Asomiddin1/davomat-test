<x-layouts.admin>
    <div x-data="{ openCreateModal: false, groupType: '', activeFilter: 'all' }">
        <main class="flex-1 p-8">
            {{-- Header --}}
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-[#2D3748]">Guruhlar</h1>
                    <p class="text-gray-500 text-sm">Barcha guruhlarni boshqaring va ko'ring</p>
                </div>
                <button @click="openCreateModal = true"
                        class="bg-[#7D8ABC] hover:bg-[#6B79A8] text-white px-5 py-2.5 rounded-xl flex items-center gap-2 transition-all shadow-sm">
                    <span class="text-xl leading-none">+</span> Guruh yaratish
                </button>
            </div>

            {{-- Guruh filtrlari --}}
            <div class="flex flex-wrap gap-3 mb-8">
                @php
                    $filters = [
                        'all'=>'Barcha guruhlar',
                        'IT'=>'IT guruhlar',
                        'JAPANESE'=>'Yapon tili guruhlari',
                        'COWORK'=>'Cowork guruhlari',
                        'PARTNER'=>'Hamkor Unversitet guruhlari',
                        'WLU'=>'Jahon tillari Unversiteti guruhlari',
                        'EMPLOYABILITY'=>'Employability guruhlari'
                    ];
                @endphp
                @foreach($filters as $key => $label)
                    <button 
                        @click="activeFilter = '{{ $key }}'"
                        :class="{ 'bg-[#7D8ABC] text-white': activeFilter === '{{ $key }}', 'bg-white text-gray-600 border border-gray-100 hover:bg-gray-50': activeFilter !== '{{ $key }}' }"
                        class="px-5 py-2 rounded-full text-sm transition-colors cursor-pointer">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            {{-- Guruh kartalari --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($groups as $group)
                    <div 
                        x-show="activeFilter === 'all' || activeFilter === '{{ $group->type }}'"
                        x-transition
                        class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-50 relative group hover:shadow-md transition-all">
                        
                        {{-- Status --}}
                        <div class="absolute top-6 right-6 flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 {{ $group->status == 'active' ? 'bg-green-500' : 'bg-red-500' }} rounded-full"></span>
                            <span class="{{ $group->status == 'active' ? 'text-green-500' : 'text-red-500' }} text-xs font-semibold">
                                {{ $group->status == 'active' ? 'Faol' : 'Nofaol' }}
                            </span>
                        </div>

                        {{-- Info --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-[#2D3748] mb-1">{{ $group->name }}</h3>
                            <p class="text-gray-400 text-sm font-medium">{{ $group->type }}</p>
                        </div>

                        {{-- Footer --}}
                        <div class="flex justify-between items-center mt-auto">
                            <div class="flex items-center gap-2 text-gray-500">
                                <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">{{ $group->students_count ?? $group->students->count() ?? 0 }} talaba</span>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.group.details', $group->id) }}" 
                                   class="bg-[#7D8ABC] text-white px-5 py-1.5 rounded-lg text-sm hover:bg-[#6B79A8] transition-colors">
                                    Ko'rish
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        {{-- Yangi guruh modal --}}
        <div x-show="openCreateModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-transition:overlay>
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="openCreateModal = false; groupType=''"></div>
            <div class="bg-white w-full max-w-md rounded-2xl p-6 relative" x-transition>
                <button @click="openCreateModal = false; groupType=''" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl leading-none">×</button>
                <h2 class="text-lg font-bold mb-4">Yangi guruh yaratish</h2>
                <form action="{{ route('admin.create.group') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Guruh nomi" required class="w-full border px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7D8ABC]">

                    {{-- Type select with Alpine.js --}}
                    <select x-model="groupType" name="type" required class="w-full border px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7D8ABC]">
                        <option value="" disabled selected>Type tanlang</option>
                        <option value="JAPANESE">JAPANESE</option>
                        <option value="IT">IT</option>
                        <option value="COWORK">COWORK</option>
                        <option value="PARTNER">PARTNER</option>
                        <option value="WLU">WLU</option>
                        <option value="EMPLOYABILITY">EMPLOYABILITY</option>
                    </select>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openCreateModal = false; groupType=''" class="px-4 py-2 rounded-xl border hover:bg-gray-50">Bekor qilish</button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-[#7D8ABC] text-white hover:bg-[#6B79A8]">Yaratish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
