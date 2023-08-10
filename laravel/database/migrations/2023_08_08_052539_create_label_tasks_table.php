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
        Schema::create('label_tasks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('label_id')->nullable();
            $table->index('label_id', 'label_task_label_idx');
            $table->foreign('label_id', 'label_task_label_fk')->on('labels')->references('id');

            $table->unsignedBigInteger('task_id')->nullable();
            $table->index('task_id', 'label_task_task_idx');
            $table->foreign('task_id', 'label_task_task_fk')->on('tasks')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_tasks');
    }
};
