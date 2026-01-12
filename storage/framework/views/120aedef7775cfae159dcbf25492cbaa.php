<script src="https://cdn.tailwindcss.com"></script>

<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-5">
        <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-sm text-center border-t-8 border-blue-500">
            
            <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center justify-center gap-2">
                <span class="text-4xl">🍅</span> Pomidoro
            </h1>
            
            <p id="status" class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-6">Fokus vaqti</p>

            <div class="relative flex items-center justify-center mb-8">
                <div class="text-7xl font-mono font-bold text-gray-800 tracking-tighter" id="display">
                    25:00
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button onclick="toggleTimer()" id="startBtn" 
                    class="w-full bg-blue-500 hover:bg-red-600 text-white font-bold py-4 rounded-2xl transition-all transform active:scale-95 shadow-lg shadow-red-200">
                    BOSHLASH
                </button>
                
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="resetTimer()" 
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-xl transition-colors">
                        Qaytarish
                    </button>
                    <button onclick="switchMode()" id="modeBtn"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-600 font-semibold py-3 rounded-xl transition-colors">
                        Ish / Tanaffus
                    </button>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
                <div class="flex justify-around text-sm text-gray-400">
                    <div>
                        <p class="font-bold text-gray-600">25m</p>
                        <p>Ish</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-600">5m</p>
                        <p>Dam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timeLeft = 25 * 60;
        let timerId = null;
        let isRunning = false;
        let currentMode = 'work'; // 'work' yoki 'break'

        const display = document.getElementById('display');
        const startBtn = document.getElementById('startBtn');
        const statusText = document.getElementById('status');

        function updateDisplay() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            display.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            document.title = `${display.textContent} - Pomodoro`;
        }

        function toggleTimer() {
            if (isRunning) {
                clearInterval(timerId);
                startBtn.textContent = "DAVOM ETTIRISH";
                startBtn.classList.replace('bg-orange-500', 'bg-blue-500');
            } else {
                timerId = setInterval(() => {
                    timeLeft--;
                    updateDisplay();
                    if (timeLeft <= 0) {
                        clearInterval(timerId);
                        alert(currentMode === 'work' ? "Ish vaqti tugadi! Dam oling." : "Tanaffus tugadi! Ishga qaytamiz.");
                        switchMode();
                    }
                }, 1000);
                startBtn.textContent = "TO'XTATISH";
                startBtn.classList.add('bg-orange-500');
            }
            isRunning = !isRunning;
        }

        function resetTimer() {
            clearInterval(timerId);
            isRunning = false;
            timeLeft = currentMode === 'work' ? 25 * 60 : 5 * 60;
            updateDisplay();
            startBtn.textContent = "BOSHLASH";
        }

        function switchMode() {
            clearInterval(timerId);
            isRunning = false;
            if (currentMode === 'work') {
                currentMode = 'break';
                timeLeft = 5 * 60;
                statusText.textContent = "Tanaffus vaqti";
                document.body.firstElementChild.classList.replace('bg-gray-100', 'bg-blue-50');
            } else {
                currentMode = 'work';
                timeLeft = 25 * 60;
                statusText.textContent = "Fokus vaqti";
                document.body.firstElementChild.classList.replace('bg-blue-50', 'bg-gray-100');
            }
            updateDisplay();
            startBtn.textContent = "BOSHLASH";
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/student/pomidor.blade.php ENDPATH**/ ?>