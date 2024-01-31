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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->integer('userID')->references('id')->on('users'); // Foreign key
            $table->integer('categoryID')->references('id')->on('category'); // Foreign key
            $table->string('taskName');
            $table->integer('priority');
            $table->date('dueDate');
            $table->float('progress');
            $table->boolean('completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
