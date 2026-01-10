<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dars jadvali - Kirish</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f0ff; /* Yengil ko‘k fon */
        }
        .btn-primary {
            background-color: #5b79ff;
        }
        .btn-primary:hover {
            background-color: #4a63e6;
        }
        .tab-active {
            background-color: #5b79ff;
            color: white;
        }
        .tab-inactive {
            background-color: white;
            color: #4b5563;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-8">

    <div class="bg-white p-8 rounded-xl shadow-2xl sm:w-2/4 w-full">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-700">Dars jadvali</h2>

        {{-- Tablar (Student / Parent) --}}
        <div class="flex rounded-lg overflow-hidden mb-6 border border-gray-200">
            <button id="tab-student" type="button"
                class="w-1/2 py-3 px-4 text-center text-sm font-medium transition-colors duration-150 rounded-l-lg"
                onclick="setRole('student')">
                Talaba
            </button>
            <button id="tab-parent" type="button"
                class="w-1/2 py-3 px-4 text-center text-sm font-medium transition-colors duration-150 rounded-r-lg"
                onclick="setRole('parent')">
                Ota-Ona
            </button>
        </div>

        {{-- Agar validatsiya xatolari bo‘lsa --}}
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Login form --}}
        <form method="POST" action="" id="login-form">
            @csrf
            <input type="hidden" name="role" id="role_input" value="{{ old('role', 'student') }}">

            <div class="mb-4">
                <input type="text" id="email" name="email" placeholder="Elektron pochta" value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <input type="password" id="password" name="password" placeholder="Parolingiz"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" id="remember" class="mr-2" onchange="toggleRemember(this)">
                <label for="remember" class="text-sm text-gray-700">Emailni eslab qol</label>
            </div>

            <button type="submit"
                class="w-full btn-primary text-white py-3 rounded-lg font-semibold text-lg hover:bg-blue-600 transition-colors duration-150">
                KIRISH
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="https://t.me/Maxamatov_Sherbek" class="text-sm text-blue-600 hover:underline">Parolni unutdingizmi?</a>
        </div>
    </div>

    <script>
        // Sahifa yuklanganda oxirgi role va emailni tiklash
        document.addEventListener('DOMContentLoaded', () => {
            const savedRole = localStorage.getItem('role') || document.getElementById('role_input').value;
            const savedEmail = localStorage.getItem('email');
            const remember = localStorage.getItem('remember');

            if (savedEmail && remember === 'true') {
                document.getElementById('email').value = savedEmail;
                document.getElementById('remember').checked = true;
            }

            setRole(savedRole);
        });

        // Role ni o‘zgartirish va saqlash
        function setRole(role) {
            localStorage.setItem('role', role);
            document.getElementById('role_input').value = role;

            const studentTab = document.getElementById('tab-student');
            const parentTab = document.getElementById('tab-parent');

            if (role === 'student') {
                studentTab.classList.add('tab-active');
                studentTab.classList.remove('tab-inactive');
                parentTab.classList.remove('tab-active');
                parentTab.classList.add('tab-inactive');
            } else {
                parentTab.classList.add('tab-active');
                parentTab.classList.remove('tab-inactive');
                studentTab.classList.remove('tab-active');
                studentTab.classList.add('tab-inactive');
            }
        }

        // Emailni eslab qolish funksiyasi
        function toggleRemember(checkbox) {
            if (checkbox.checked) {
                const email = document.getElementById('email').value;
                localStorage.setItem('email', email);
                localStorage.setItem('remember', 'true');
            } else {
                localStorage.removeItem('email');
                localStorage.setItem('remember', 'false');
            }
        }

        // Email o‘zgarganda avtomatik saqlash (agar checkbox belgilangan bo‘lsa)
        document.getElementById('email').addEventListener('input', () => {
            const remember = localStorage.getItem('remember') === 'true';
            if (remember) {
                localStorage.setItem('email', document.getElementById('email').value);
            }
        });
    </script>
</body>
</html>