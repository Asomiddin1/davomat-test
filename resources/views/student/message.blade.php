@vite(['resources/css/app.css', 'resources/js/app.js'])
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    [x-cloak] { display: none !important; }
</style>

<x-layout>
    <div class="p-8 bg-[#f8f9fa] min-h-screen">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-[#343a40]">Xabarlar</h1>
            <p class="text-gray-500 text-sm mt-1">Sizga yuborilgan xabarlar</p>
        </div>

      <div class="space-y-4">
    @forelse($messages as $msg)
        <div id="message-{{ $msg->id }}"
             class="bg-white border border-gray-100 rounded-[24px] p-7 shadow-sm
                    flex justify-between items-start transition-all hover:shadow-md">

            {{-- LEFT --}}
            <div class="flex gap-5 text-left">
                <div
                    class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0
                    {{ $msg->target_type == 'student' ? 'bg-[#f0f2ff]' : 'bg-[#f5f3ff]' }}">
                    @if($msg->target_type == 'student')
                        <i data-lucide="user" class="w-6 h-6 text-[#7c83a7]"></i>
                    @else
                        <i data-lucide="users" class="w-6 h-6 text-[#9d72ff]"></i>
                    @endif
                </div>

                <div>
                    <h3 class="text-[18px] font-semibold text-[#343a40]">
                        {{ $msg->title }}
                    </h3>

                    <p class="text-gray-500 text-[14px] mt-0.5">
                        @if($msg->target_type == 'all')
                            Hammaga
                        @elseif($msg->target_type == 'group')
                            Guruh: {{ $msg->group->name ?? '-' }}
                        @elseif($msg->target_type == 'student')
                            Sizga
                        @endif
                    </p>

                    <p class="text-[#4a5568] mt-4 leading-relaxed text-[15px] max-w-2xl">
                        {{ $msg->body }}
                    </p>

                    <div class="flex items-center gap-2 mt-4 text-gray-400 text-sm">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>
                            {{ $msg->created_at->format('d M Y H:i') }}
                            · {{ $msg->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex flex-col items-end justify-between self-stretch gap-3">
                <span id="badge-{{ $msg->id }}"
                      class="px-3 py-1 rounded-full text-[12px] font-medium
                      {{ $msg->is_read ? 'bg-gray-100 text-gray-600' : 'bg-[#e7f9f3] text-[#28a745]' }}">
                    {{ $msg->is_read ? "O‘qilgan" : "Yangi" }}
                </span>

                @if(!$msg->is_read)
                    <button onclick="markAsRead({{ $msg->id }})"
                            class="px-4 py-2 text-sm rounded-full
                                   bg-[#7c83a7] hover:bg-[#6b7294]
                                   text-white transition  cursor-pointer">
                        O‘qildi deb belgilash
                    </button>
                @endif
            </div>
        </div>

    @empty
        {{-- ❌ XABAR YO‘Q --}}
        <div class="bg-white border border-gray-100 rounded-[24px] p-12
                    text-center shadow-sm">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center
                        rounded-full bg-gray-100 text-gray-400">
                <i data-lucide="mail-open" class="w-10 h-10"></i>
            </div>

            <h3 class="text-xl font-semibold text-gray-700">
                Hozircha sizda xabarlar yo‘q
            </h3>
            <p class="text-gray-500 mt-2">
                Yangi xabarlar yuborilganda shu yerda ko‘rinadi
            </p>
        </div>
    @endforelse
</div>


        <div class="mt-8">
            {{ $messages->links() }}
        </div>
    </div>

    {{-- JS --}}
    <script>
        function markAsRead(id) {
            fetch(`/student/messages/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('badge-' + id).innerText = "O‘qilgan";
                    document.getElementById('badge-' + id).className =
                        "px-3 py-1 rounded-full text-[12px] font-medium bg-gray-100 text-gray-600";

                    const btn = document.querySelector(`#message-${id} button`);
                    if (btn) btn.remove();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</x-layout>
