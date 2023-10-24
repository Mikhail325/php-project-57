<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $tableName;
    private array $formData;
    private User $user;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $task = Task::factory()->make();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
        $this->tableName = $task->getTable();
        $this->formData = $task->only(
            [
                'name',
                'description',
                'status_id',
                'assigned_to_id',
            ]
        );
    }

    public function testIndex(): void
    {
        $this->get(route('tasks.index'))
            ->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->get(route('tasks.create'))
            ->assertStatus(403);

        $this->actingAs($this->user)->get(route('tasks.create'))
            ->assertStatus(200);
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)->post(route('tasks.store', []))
            ->assertSessionHasErrors(['name', 'status_id', 'assigned_to_id']);

        $this->actingAs($this->user)->post(route('tasks.store', $this->formData))
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testEdit(): void
    {
        $this->get(route('tasks.edit', $this->task))
            ->assertStatus(403);

        $this->actingAs($this->user)
            ->get(route('tasks.edit', $this->task))
            ->assertRedirect(route('tasks.index'));

        $task = Task::factory()->create(['created_by_id' => $this->user]);
        $this->actingAs($this->user)
            ->get(route('tasks.edit', $task))
            ->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->formData)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testDestroy(): void
    {
        $this->delete(route('tasks.destroy', $this->task))
            ->assertStatus(403);

        $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $this->task))
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }
}
