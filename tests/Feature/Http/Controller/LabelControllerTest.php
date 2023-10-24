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

    public function testIndex(): void
    {
        $this->actingAs($this->user)->get(route('labels.index'))
            ->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->get(route('labels.create'))
            ->assertStatus(403);

        $this->actingAs($this->user)->get(route('labels.create'))
            ->assertStatus(200);
    }

    public function testStore(): void
    {
        $this->actingAs($this->user)->post(route('labels.store', []))
            ->assertSessionHasErrors(['name']);

        $this->actingAs($this->user)->post(route('labels.store', $this->formData))
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testEdit(): void
    {
        $this->get(route('labels.edit', $this->label))
            ->assertStatus(403);

        $this->actingAs($this->user)->get(route('labels.edit', $this->label))
            ->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $this->formData)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas($this->tableName, $this->formData);
    }

    public function testDestroy(): void
    {
        LabelTask::factory()->create(['label_id' => $this->label]);
        $this->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label))
            ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas($this->tableName, $this->label->only(
            [
                'name',
                'description',
            ]
        ));
        $this->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label))
            ->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing($this->tableName, $this->formData);
    }
}
