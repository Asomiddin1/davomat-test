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
       Schema::create('groups', function (Blueprint $table) {
       $table->id();
       $table->string('name'); // group nomi
       $table->enum('status', ['active', 'inactive'])->default('active'); // group holati
       $table->enum('type', ['JAPANESE', 'IT', 'COWORK', 'PARTNER', 'WLU' , 'EMPLOYABILITY']);
       $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
