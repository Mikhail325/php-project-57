<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabelTask>
 */
class LabelTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label_id' => Label::factory()->create(),
            'task_id' => Task::factory()->create(),
        ];
    }
}
