<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Task, Label, TaskStatus};

class LabelsTest extends TestCase
{
    use RefreshDatabase;

    private $actingUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
    }

    public function test_creating_label(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->post(route('labels.store'), ['name' => "newTestLabel"]);

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'newTestLabel']);
    }

    public function test_creating_label_by_guest(): void
    {
        $response = $this->post(route('labels.store'), ['name' => "newTestLabel"]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('labels', ['name' => 'newTestLabel']);
    }

    public function test_editing_label(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('labels.update', $testLabel), [
                'name' => "editedTestLabel"
            ]);

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'editedTestLabel']);
    }

    public function test_editing_label_by_guest(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this->patch(route('labels.update', $testLabel), ['name' => "editedTestLabel"]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('labels', ['name' => 'editedTestLabel']);
    }

    public function test_destroying_label(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('labels.destroy', $testLabel));

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['name' => $testLabel->name]);
    }

    public function test_destroying_label_by_guest(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', $testLabel));

        $response->assertStatus(403);
        $this->assertDatabaseHas('labels', ['name' => $testLabel->name]);
    }

    public function test_destroying_bounded_with_task_label(): void
    {
        $testLabel = Label::factory()->create();
        $status = TaskStatus::factory()->create();
        $task = new Task([
            'name' => 'testTask',
            'status_id' => $status->id,
            'created_by_id' => $this->actingUser->id
        ]);
        $task->save();
        $task->labels()->attach($testLabel->id);

        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('labels.destroy', $testLabel));

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => $testLabel->name]);
    }
}
