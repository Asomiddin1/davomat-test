<x-layouts.app>
    <div class="w-full p-3 md:p-6 min-h-screen space-y-4 md:space-y-6 bg-[#f8faff]">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
            <h1 class="text-xl md:text-2xl font-bold text-gray-700">Dars Jadvali</h1>
            <div class="flex bg-gray-100 p-1 rounded-xl w-full sm:w-auto">
                <button class="flex-1 sm:px-5 py-2 bg-white shadow-sm rounded-lg text-sm font-bold text-slate-700">Kunlik</button>
                <button class="flex-1 sm:px-5 py-2 text-sm font-semibold text-gray-400 hover:text-gray-600 transition">Haftalik</button>
            </div>
        </div>

        <div class="bg-white p-3 md:p-4 rounded-2xl shadow-sm border border-gray-50">
            <div class="flex items-center gap-2">
                <a href="?date={{ $selectedDate->copy()->subWeek()->format('Y-m-d') }}" class="hidden md:block p-2 hover:bg-gray-100 rounded-full text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                
                <div class="flex flex-1 gap-2 md:gap-4 overflow-x-auto pb-2 scrollbar-hide snap-x">
                    @foreach($weekDays as $day)
                        @php 
                            $isToday = $day->isSameDay($selectedDate); 
                            // Carbon ba'zan kirill chiqarib yuborsa, qo'lda to'g'irlash (kafolat)
                            $monthName = str_replace(['Январь', 'Февраль'], ['Yanvar', 'Fevral'], $day->translatedFormat('F'));
                            $dayName = $day->translatedFormat('D');
                        @endphp
                        <a href="?date={{ $day->format('Y-m-d') }}" 
                           class="flex flex-col items-center min-w-[75px] md:flex-1 py-3 rounded-2xl transition-all duration-200 snap-center {{ $isToday ? 'bg-blue-50 border border-blue-200 ring-2 ring-blue-50' : 'hover:bg-gray-50 border border-transparent' }}">
                            <span class="text-[10px] md:text-[11px] uppercase tracking-tighter {{ $isToday ? 'text-blue-500 font-bold' : 'text-gray-400 font-medium' }}">
                                {{ $day->translatedFormat('F') }}
                            </span>
                            <span class="text-lg md:text-xl font-black my-0.5 md:my-1 {{ $isToday ? 'text-blue-600' : 'text-slate-700' }}">
                                {{ $day->format('d') }}
                            </span>
                            <span class="text-[10px] md:text-[11px] {{ $isToday ? 'text-blue-500 font-bold' : 'text-gray-500 font-medium' }}">
                                {{ $day->translatedFormat('l') }}
                            </span>
                        </a>
                    @endforeach
                </div>

                <a href="?date={{ $selectedDate->copy()->addWeek()->format('Y-m-d') }}" class="hidden md:block p-2 hover:bg-gray-100 rounded-full text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <div class="bg-white p-4 md:p-8 rounded-3xl shadow-sm border border-gray-50">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                <h2 class="text-lg md:text-xl font-extrabold text-slate-800 tracking-tight">Kunlik Dars Jadvali</h2>
                <span class="text-slate-400 text-xs md:text-sm font-bold bg-slate-50 px-4 py-1.5 rounded-xl border border-slate-100">
                    {{ $selectedDate->translatedFormat('d - F, l') }}
                </span>
            </div>

            <div class="space-y-4 md:space-y-6">
                @forelse($lessons as $index => $lesson)
                    @php
                        $colors = [
                            ['bg' => 'bg-slate-500', 'border' => 'border-slate-500'],
                            ['bg' => 'bg-emerald-500', 'border' => 'border-emerald-500'],
                            ['bg' => 'bg-orange-500', 'border' => 'border-orange-500']
                        ];
                        $c = $colors[$index % 3];
                    @endphp

                    <div class="flex flex-row border {{ $c['border'] }} rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition group h-full">
                        <div class="w-20 md:w-32 {{ $c['bg'] }} text-white flex flex-col items-center justify-center p-2 md:p-4">
                            <span class="text-sm md:text-lg font-bold">{{ \Carbon\Carbon::parse($lesson->start_time)->format('H:i') }}</span>
                            <div class="h-6 md:h-8 w-[1px] md:w-[2px] bg-white/30 my-1 md:my-2"></div>
                            <span class="text-sm md:text-lg font-bold">{{ \Carbon\Carbon::parse($lesson->end_time)->format('H:i') }}</span>
                        </div>

                        <div class="flex-1 p-3 md:p-5 relative bg-white flex flex-col justify-center">
                            <div class="pr-2 md:pr-20">
                                <h3 class="text-sm md:text-xl font-bold text-slate-800 group-hover:text-blue-600 transition line-clamp-2">
                                    {{ $lesson->subject->name ?? 'Fan nomi' }}
                                </h3>
                                
                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                    <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] md:text-[10px] font-bold rounded border border-blue-100 uppercase">
                                        {{ $lesson->group->name }}
                                    </span>
                                    <span class="px-2 py-0.5 bg-slate-50 text-slate-500 text-[9px] md:text-[10px] font-black rounded-lg border border-slate-100 uppercase">
                                        {{ $lesson->room }}-xona
                                    </span>
                                </div>
                            </div>

                            <p class="mt-3 md:absolute md:bottom-5 md:right-6 text-[9px] md:text-[11px] font-black text-slate-300 uppercase tracking-widest md:text-right">
                                {{ $lesson->teacher->full_name ?? 'Noma\'lum' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 md:py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 text-center">
                        <div class="bg-white p-4 rounded-full shadow-sm mb-4 text-slate-200">
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold text-sm md:text-base uppercase tracking-wider">Bugun uchun darslar belgilanmagan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>