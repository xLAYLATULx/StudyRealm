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
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('id')->on('users');
            $table->unsignedBigInteger('categoryID');
            $table->foreign('categoryID')->references('id')->on('category');
            $table->string('taskName');
            $table->text('description');
            $table->enum('priority', ['high', 'medium', 'low']);
            $table->date('dueDate');
            $table->float('progress', 5, 2)->default(0.00);
            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('goalID')->nullable();
            $table->foreign('goalID')->references('id')->on('goal');
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
