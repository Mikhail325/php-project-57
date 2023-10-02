<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusesControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $tableName;
    private array $formData;
    private User $user;
    private TaskStatus $taskStatus;
    
    protected function setUp(): void
    {
        parent::setUp();

        $taskStatus = TaskStatus::factory()->make();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->tableName = $taskStatus->getTable();
        $this->formData = $taskStatus->only(['name']);
    }
// test index
    public function test_connection_index_user_task_status(): void
    {
        $this->actingAs($this->user)->get(route('status.index'))
            ->assertStatus(200);
    }

    public function test_connection_index_guest_task_status(): void
    {
        $this->get(route('status.index'))
            ->assertStatus(200);
    }
//test create
    public function test_connection_create_user_task_status(): void//11111111111111111111111
    {
        $this->actingAs($this->user)->get(route('status.create'))
            ->assertStatus(200);
    }

    public function test_connection_create_guest_task_status(): void
    {
        $this->get(route('status.create'))
            ->assertStatus(403);
    }

//test store
    public function test_connection_store_user_task_status(): void
    {
        $this->actingAs($this->user)->post(route('status.store', $this->formData))
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test edit
    public function test_connection_edit_user_task_status(): void
    {
        $this->actingAs($this->user)->get(route('status.edit', $this->taskStatus))
            ->assertStatus(200);
    }

    public function test_connection_edit_guest_task_status(): void
    {
        $this->get(route('status.edit', $this->taskStatus))
            ->assertStatus(403);
    }
//test update
    public function test_connection_update_user_task_status(): void
    {
        $this->actingAs($this->user)
            ->patch(route('status.update', $this->taskStatus), $this->formData)
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test destroy
    public function test_connection_destroy_user_task_status(): void
    {
        $this->actingAs($this->user)
            ->delete(route('status.destroy', $this->taskStatus))
            ->assertRedirect(route('status.index'));
                
        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }

    public function test_connection_destroy_user_task_status_(): void
    {
        Task::factory()->create(['status_id' => $this->taskStatus]);
        $this->actingAs($this->user)
            ->delete(route('status.destroy', $this->taskStatus))
            ->assertRedirect(route('status.index'));
                
        $this->assertDatabaseHas($this->tableName, $this->taskStatus->only(['name',]));
    }
}
