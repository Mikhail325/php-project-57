<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
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
        $this->actingAs($this->user)->get(route('tasks.create'))
            ->assertStatus(200);
    }

    public function testCreateUnathorized(): void
    {
        $this->get(route('tasks.create'))
            ->assertStatus(403);
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)->post(route('tasks.store', $this->formData))
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testStoreEmptyField(): void
    {
        $this->actingAs($this->user)->post(route('tasks.store', []))
            ->assertSessionHasErrors(['name', 'status_id']);
    }

    public function testEdit(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user]);
        $this->actingAs($this->user)
            ->get(route('tasks.edit', $task))
            ->assertStatus(200);
    }

    public function testEditUnathorized(): void
    {
        $this->get(route('tasks.edit', $this->task))
            ->assertStatus(403);
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
        $task = Task::factory()->create(['created_by_id' => $this->user]);
        $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $task))
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }

    public function testDestroyUnathorized(): void
    {
        $this->delete(route('tasks.destroy', $this->task))
            ->assertStatus(403);
    }
}
