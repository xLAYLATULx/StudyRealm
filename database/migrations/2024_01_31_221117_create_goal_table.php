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
        Schema::create('goal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->references('id')->on('users'); // Foreign keyphp artisan migrate:status
            $table->string('goalName');
            $table->string('description');
            $table->float('progress', 8, 2)->default(0.00);
            $table->date('deadline');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal');
    }
};
