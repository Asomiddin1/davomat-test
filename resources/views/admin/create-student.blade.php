@vite(['resources/css/app.css', 'resources/js/app.js'])
{!! ToastMagic::styles() !!}
<div class="flex custom_bg">
    <div>
        @include('components.admin-components.sidebar')
    </div>
    <div class="w-full h-[100vh] overflow-y-scroll">
<div class="flex items-center justify-center p-10">
     {!! ToastMagic::scripts() !!}
    <div class="mx-auto w-full max-w-[850px] bg-white px-8 py-10 shadow-lg  rounded-lg">
        <form method="POST" action="{{ route('admin.create.student.post') }}">
            @csrf
             <div class="mb-5">
                <label for="student_id" class="mb-3 block text-base font-medium text-[#07074D]">
                  Talaba ID raqami
                </label>
                <input type="text" name="student_id" id="student_id" placeholder="Talaba ID raqamingizni kiriting"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="mb-5">
                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                   To'liq ismi
                </label>
                <input type="text" name="name" id="name" placeholder="Full Name"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="mb-5">
                <label for="phone_number" class="mb-3 block text-base font-medium text-[#07074D]">
                    Telefon raqami
                </label>
                <input type="text" name="phone_number" id="phone" placeholder="Telefon raqamingizni kiriting"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="mb-5">
                <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                    Email manzili
                </label>
                <input type="email" name="email" id="email" placeholder="Email manzilingizni kiriting"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
         

            <div class="mb-5 pt-3">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="">Parol</label>
                        <input type="password" name="password" id="password" placeholder="Parolni kiriting"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div>
                        <label for="">Parolni takrorlang</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Parolni takrorlang"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />    
                    </div>
                </div>
            </div>

            <div>
                <button
                    class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none cursor-pointer">
                    Talabani yaratish
                </button>
            </div>
        </form>
    </div>
</div>
    </div>
</div>