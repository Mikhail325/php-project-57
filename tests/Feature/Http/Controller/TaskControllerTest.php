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
// test index
    public function testConnectionIndexUserTask(): void
    {
        $this->actingAs($this->user)->get(route('task.index'))
            ->assertStatus(200);
    }

    public function testConnectionIndexGuestTask(): void
    {
        $this->get(route('task.index'))
            ->assertStatus(200);
    }
//test create
    public function testConnectionCreateUserTask(): void
    {
        $this->actingAs($this->user)->get(route('task.create'))
            ->assertStatus(200);
    }

    public function testConnectionCreateGuestTask(): void
    {
        $this->get(route('task.create'))
            ->assertStatus(403);
    }

//test store
    public function testConnectionStoreUserTask(): void
    {
        $this->actingAs($this->user)->post(route('task.store', $this->formData))
            ->assertRedirect(route('task.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test edit
    public function testConnectionEditUserTask(): void
    {
        $this->actingAs($this->user)->get(route('task.edit', $this->task))
            ->assertStatus(200);
    }

    public function testConnectionEditGuestTask(): void
    {
        $this->get(route('task.edit', $this->task))
            ->assertStatus(403);
    }
//test update
    public function testConnectionUpdateUserTask(): void
    {
        $this->actingAs($this->user)
            ->patch(route('task.update', $this->task), $this->formData)
            ->assertRedirect(route('task.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test destroy
    public function testConnectionDestroyUserTask(): void
    {
        $this->actingAs($this->user)
            ->delete(route('task.destroy', $this->task))
            ->assertRedirect(route('task.index'));

        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }

    public function testConnectionDestroyGuestTask(): void
    {
        $this->delete(route('task.destroy', $this->task))
            ->assertStatus(403);
    }
}
