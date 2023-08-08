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
            $table->string('name');

            $table->unsignedBigInteger('status_id')->nullable();
            $table->index('status_id', 'task_status_idx');
            $table->foreign('status_id', 'task_status_fk')->on('statuses')->references('id');

            $table->unsignedBigInteger('label_id')->nullable();
            $table->index('label_id', 'task_label_idx');
            $table->foreign('label_id', 'task_label_fk')->on('labels')->references('id');

            $table->unsignedBigInteger('user_author_id')->nullable();
            $table->index('user_author_id', 'task_user_author_idx');
            $table->foreign('user_author_id', 'task_user_author_fk')->on('users')->references('id');

            $table->unsignedBigInteger('user_executor_id')->nullable();
            $table->index('user_executor_id', 'task_user_executor_idx');
            $table->foreign('user_executor_id', 'task_user_executor_fk')->on('users')->references('id');

            $table->timestamps();
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
