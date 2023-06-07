<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Task, User, TaskStatus};

class TasksTest extends TestCase
{
    use RefreshDatabase;

    private $actingUser;
    private $status;
    private $taskData;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
        $this->taskData = [
            'name' => 'TestName',
            'status_id' => $this->status->id,
            'created_by_id' => $this->actingUser->id
        ];
    }

    public function test_creating_new_task(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->post(route('tasks.store'), $this->taskData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $this->taskData);
    }

    public function test_creating_new_task_by_guest(): void
    {
        $response = $this
            ->post(route('tasks.store'), $this->taskData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $this->taskData);
    }

    public function test_editing_task(): void
    {
        
        $task = new Task($this->taskData);
        $task->save();
        $this->taskData['name'] = 'newTaskName';

        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('tasks.update', ['task' => $task]), $this->taskData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $this->taskData);
    }

    public function test_editing_task_by_guest(): void
    {
        $task = new Task($this->taskData);
        $task->save();
        $this->taskData['name'] = 'newTaskName2';

        $response = $this
            ->patch(route('tasks.update', ['task' => $task]), $this->taskData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $this->taskData);
    }

    public function test_destroying_task(): void
    {
        $task = new Task($this->taskData);
        $task->save();

        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('tasks.destroy', ['task' => $task]));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', $this->taskData);
    }

    public function test_destroying_task_not_by_creator(): void
    {
        $task = new Task($this->taskData);
        $task->save();
        $testUser = User::factory()->create();

        $response = $this
            ->actingAs($testUser)
            ->delete(route('tasks.destroy', ['task' => $task]));

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', $this->taskData);
    }
}
