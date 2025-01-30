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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('description', 2048)->nullable();
            $table->dateTime('deadline')->nullable(false);
            $table->boolean("completed")->nullable(false)->default(false);
            $table->unsignedBigInteger('todo_list_id');
            $table->timestamps();
            $table->foreign("todo_list_id")->references('id')->on('todo_lists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
