<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{TaskStatus, User, Task}; 

class TaskStatusesTest extends TestCase
{
    use RefreshDatabase;

    private $actingUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
    }

    public function test_creating_status(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->post(route('task_statuses.store'), ['name' => "newTestStatus"]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'newTestStatus']);
    }

    public function test_creating_status_by_guest(): void
    {
        $response = $this->post(route('task_statuses.store'), ['name' => "newTestStatus"]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', ['name' => 'newTestStatus']);
    }

    public function test_editing_status(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('task_statuses.update', $testStatus), [
                'name' => "editedTestStatus"
            ]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'editedTestStatus']);
    }

    public function test_editing_status_by_guest(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this->patch(route('task_statuses.update', $testStatus), [
            'name' => "editedTestStatus"
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', ['name' => 'editedTestStatus']);
    }

    public function test_destroying_status(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('task_statuses.destroy', $testStatus));

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['name' => $testStatus->name]);
    }

    public function test_destroying_status_by_guest(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this->delete(route('task_statuses.destroy', $testStatus));

        $response->assertStatus(403);
        $this->assertDatabaseHas('task_statuses', ['name' => $testStatus->name]);
    }

    public function test_destroying_bounded_with_task_status(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $task = new Task([
            'name' => 'testTask',
            'status_id' => $testStatus->id,
            'created_by_id' => $this->actingUser->id
        ]);
        $task->save();

        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('task_statuses.destroy', $testStatus));

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => $testStatus->name]);
    }
}
