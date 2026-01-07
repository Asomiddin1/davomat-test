<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('lessons', function (Blueprint $table) {
    $table->id();

    // BOR groups jadvaliga bog‘lanadi
    $table->foreignId('group_id')
          ->constrained('groups')
          ->cascadeOnDelete();

    $table->foreignId('subject_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('teacher_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->date('lesson_date');
    $table->time('start_time');
    $table->time('end_time');
    $table->string('room', 20); // 203, 304

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
