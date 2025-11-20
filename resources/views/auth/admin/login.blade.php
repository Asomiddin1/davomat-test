<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kirish - Dars Jadvali</title>
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
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-8">

    <div class="bg-white p-8 rounded-xl shadow-2xl sm:w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-8 text-gray-700">Admin Kirish</h2>

        {{-- Laravel POST form --}}
        <form method="POST" action="{{ route('admin.login') }}" id="admin-login-form">
            @csrf

            <input type="hidden" name="role" value="admin">

            {{-- Email --}}
            <div class="mb-4">
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Elektron pochta" 
                    required
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 
                    @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Parol --}}
            <div class="mb-6">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Parolingiz" 
                    required
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 
                    @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit tugma --}}
            <button 
                type="submit" 
                class="w-full btn-primary text-white py-3 rounded-lg font-semibold text-lg hover:bg-blue-600 transition-colors duration-150"
            >
                KIRISH
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="https://t.me/Maxamatov_Sherbek" class="text-sm text-blue-600 hover:underline">
                Parolni unutdingizmi?
            </a>
        </div>
    </div>

</body>
</html>
