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
        Schema::create('pomodorosession', function (Blueprint $table) {
            $table->id();
            $table->integer('userID')->references('id')->on('users'); // Foreign key
            $table->date('startTime');
            $table->date('endTime');
            $table->date('breakStartTime');
            $table->date('breakEndTime');
            $table->boolean('completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pomodorosession');
    }
};
