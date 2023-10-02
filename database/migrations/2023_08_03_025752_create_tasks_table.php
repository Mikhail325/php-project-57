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
            $table->string('description');

            $table->unsignedBigInteger('status_id')->nullable();
            $table->index('status_id', 'task_status_idx');
            $table->foreign('status_id', 'task_status_fk')->on('task_statuses')->references('id');

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->index('created_by_id', 'task_created_by_idx');
            $table->foreign('created_by_id', 'task_created_by_fk')->on('users')->references('id');

            $table->unsignedBigInteger('assigned_to_id')->nullable();
            $table->index('assigned_to_id', 'task_assigned_to_idx');
            $table->foreign('assigned_to_id', 'task_assigned_to_fk')->on('users')->references('id');

            $table->timestamps();
            $table->softDeletes();
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
