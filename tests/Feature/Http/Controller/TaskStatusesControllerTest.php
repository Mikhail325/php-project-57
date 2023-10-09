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
    public function testConnectionIndexUserTaskStatus(): void
    {
        $this->actingAs($this->user)->get(route('status.index'))
            ->assertStatus(200);
    }

    public function testConnectionIndexGuestTaskStatus(): void
    {
        $this->get(route('status.index'))
            ->assertStatus(200);
    }
//test create
    public function testConnectionCreateUserTaskStatus(): void
    {
        $this->actingAs($this->user)->get(route('status.create'))
            ->assertStatus(200);
    }

    public function testConnectionCreateGuestTaskStatus(): void
    {
        $this->get(route('status.create'))
            ->assertStatus(403);
    }

//test store
    public function testConnectionStoreUserTaskStatus(): void
    {
        $this->actingAs($this->user)->post(route('status.store', $this->formData))
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test edit
    public function testConnectionEditUserTaskStatus(): void
    {
        $this->actingAs($this->user)->get(route('status.edit', $this->taskStatus))
            ->assertStatus(200);
    }

    public function testConnectionEditGuestTaskStatus(): void
    {
        $this->get(route('status.edit', $this->taskStatus))
            ->assertStatus(403);
    }
//test update
    public function testConnectionUpdateUserTaskStatus(): void
    {
        $this->actingAs($this->user)
            ->patch(route('status.update', $this->taskStatus), $this->formData)
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test destroy
    public function testConnectionDestroyUserTaskStatusFalse(): void
    {
        $this->actingAs($this->user)
            ->delete(route('status.destroy', $this->taskStatus))
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }

    public function testConnectionDestroyUserTaskStatus(): void
    {
        Task::factory()->create(['status_id' => $this->taskStatus]);
        $this->actingAs($this->user)
            ->delete(route('status.destroy', $this->taskStatus))
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas($this->tableName, $this->taskStatus->only(['name',]));
    }
}
