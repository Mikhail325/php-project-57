<?php

namespace Tests\Feature\Http\Controller;

use App\Models\Label;
use App\Models\User;
use App\Models\LabelTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $tableName;
    private array $formData;
    private User $user;
    private Label $label;
    
    protected function setUp(): void
    {
        parent::setUp();

        $label = Label::factory()->make();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
        $this->tableName = $label->getTable();
        $this->formData = $label->only(
            [
                'name',
                'description',
            ]
        );
    }
// test index
    public function test_connection_index_user_label(): void
    {
        $this->actingAs($this->user)->get(route('label.index'))
            ->assertStatus(200);
    }

    public function test_connection_index_guest_label(): void
    {
        $this->get(route('label.index'))
            ->assertStatus(200);
    }
//test create
    public function test_connection_create_user_label(): void//11111111111111111111111
    {
        $this->actingAs($this->user)->get(route('label.create'))
            ->assertStatus(200);
    }

    public function test_connection_create_guest_label(): void
    {
        $this->get(route('label.create'))
            ->assertStatus(403);
    }

//test store
    public function test_connection_store_user_label(): void
    {
        $this->actingAs($this->user)->post(route('label.store', $this->formData))
            ->assertRedirect(route('label.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test edit
    public function test_connection_edit_user_label(): void
    {
        $this->actingAs($this->user)->get(route('label.edit', $this->label))
            ->assertStatus(200);
    }

    public function test_connection_edit_guest_label(): void
    {
        $this->get(route('label.edit', $this->label))
            ->assertStatus(403);
    }
//test update
    public function test_connection_update_user_label(): void
    {
        $this->actingAs($this->user)
            ->patch(route('label.update', $this->label), $this->formData)
            ->assertRedirect(route('label.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

//test destroy
    public function test_connection_destroy_user_label(): void
    {
        $this->actingAs($this->user)
            ->delete(route('label.destroy', $this->label))
            ->assertRedirect(route('label.index'));
                
        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }

    public function test_connection_destroy_user_label_related_task(): void
    {
        LabelTask::factory()->create(['label_id' => $this->label]);
        $this->actingAs($this->user)
            ->delete(route('label.destroy', $this->label))
            ->assertRedirect(route('label.index'));
                
        $this->assertDatabaseHas($this->tableName, $this->label->only(
            [
                'name',
                'description',
            ]
        ));
    }
}
