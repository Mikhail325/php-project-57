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
    public function test_connection_index_user_task(): void
    {
        $this->actingAs($this->user)->get(route('task.index'))
            ->assertStatus(200);
    }

    public function test_connection_index_guest_task(): void
    {
        $this->get(route('task.index'))
            ->assertStatus(200);
    }
//test create
    public function test_connection_create_user_task(): void
    {
        $this->actingAs($this->user)->get(route('task.create'))
            ->assertStatus(200);
    }

    public function test_connection_create_guest_task(): void
    {
        $this->get(route('task.create'))
            ->assertStatus(403);
    }

//test store
    public function test_connection_store_user_task(): void
    {
        $this->actingAs($this->user)->post(route('task.store', $this->formData))
            ->assertRedirect(route('task.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test edit
    public function test_connection_edit_user_task(): void
    {
        $this->actingAs($this->user)->get(route('task.edit', $this->task))
            ->assertStatus(200);
    }

    public function test_connection_edit_guest_task(): void
    {
        $this->get(route('task.edit', $this->task))
            ->assertStatus(403);
    }
//test update
    public function test_connection_update_user_task(): void
    {
        $this->actingAs($this->user)
            ->patch(route('task.update', $this->task), $this->formData)
            ->assertRedirect(route('task.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test destroy
    public function test_connection_destroy_user_task(): void
    {
        $this->actingAs($this->user)
            ->delete(route('task.destroy', $this->task))
            ->assertRedirect(route('task.index'));
                
        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }

    public function test_connection_destroy_guest_task(): void
    {
        $this->delete(route('task.destroy', $this->task))
            ->assertStatus(403);
    }
}
