<x-layouts.app>
    <div class="min-h-screen bg-indigo-50 p-8 font-sans">
        <div class="max-w-6xl mx-auto bg-white rounded-3xl p-6 shadow-sm flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($student->fullname) }}&background=random" alt="Avatar" class="w-20 h-20 rounded-full border-2 border-indigo-100">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $student->fullname }}</h1>
                    <p class="text-gray-500">ID: {{ $student->student_id }}</p>
                </div>
            </div>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Mening Gruhlarim
            </button>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm">Fakultet</span>
                    <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">🏢</span>
                </div>
                <p class="font-bold text-gray-800">Kompyuter Fanlari</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm">Telefon</span>
                    <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">📞</span>
                </div>
                <p class="font-bold text-gray-800">{{ $student->phone_number }}</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm">Email</span>
                    <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">✉️</span>
                </div>
                <p class="font-bold text-gray-800 text-xs break-all">{{ $student->email }}</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm">Umumiy Davomat</span>
                    <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">📊</span>
                </div>
                <p class="font-bold text-gray-800">92%</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm">Joriy Semestr</span>
                    <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">🎓</span>
                </div>
                <p class="font-bold text-gray-800">6</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-sm">GPA</span>
                    <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">🏆</span>
                </div>
                <p class="font-bold text-gray-800">4.2</p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Fanlar va Davomat</h2>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm">
                        <th class="p-4 font-semibold">Fan nomi</th>
                        <th class="p-4 font-semibold">Kreditlari (Baho)</th>
                        <th class="p-4 font-semibold text-right">Davomat</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-t border-gray-100">
                        <td class="p-4">Algoritmlar</td>
                        <td class="p-4"><span class="text-green-600 font-bold">A</span> <span class="ml-2 text-green-500">✓</span></td>
                        <td class="p-4 text-right">95%</td>
                    </tr>
                    <tr class="border-t border-gray-100">
                        <td class="p-4">Ma'lumotlar bazasi</td>
                        <td class="p-4"><span class="text-green-600 font-bold">B</span> <span class="ml-2 text-green-500">✓</span></td>
                        <td class="p-4 text-right">89%</td>
                    </tr>
                    <tr class="border-t border-gray-100">
                        <td class="p-4">Kompyuter tarmoqlari</td>
                        <td class="p-4"><span class="text-green-600 font-bold">C</span> <span class="ml-2 text-green-500">✓</span></td>
                        <td class="p-4 text-right">75%</td>
                    </tr>
                    <tr class="border-t border-gray-100">
                        <td class="p-4 font-medium text-red-500">Sun'iy intellekt</td>
                        <td class="p-4"><span class="text-red-500 font-bold">F</span> <span class="ml-2 text-red-500">✕</span></td>
                        <td class="p-4 text-right text-red-500">35%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>