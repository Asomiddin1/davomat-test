<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();

            $table->string('subject');          // Fan nomi
            $table->date('lesson_date');        // Aniq sana
            $table->time('start_time');         // Dars boshlanish vaqti
            $table->time('end_time');           // Dars tugash vaqti
            $table->unsignedTinyInteger('weekday'); // Haftaning kuni: 1=Dushanba, 7=Yakshanba

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
