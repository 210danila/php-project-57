<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Task, User, TaskStatus};

class TaskTest extends TestCase
{
    private User $actingUser;
    private TaskStatus $status;
    private array $taskData;

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

    public function testIndex(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('tasks.index'));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('tasks.create'));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $testTask = Task::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('tasks.edit', $testTask));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->post(route('tasks.store'), $this->taskData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $this->taskData);
    }

    public function testStoreAsGuest(): void
    {
        $response = $this
            ->post(route('tasks.store'), $this->taskData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $this->taskData);
    }

    public function testUpdate(): void
    {
        $task = Task::factory($this->taskData)->create();
        $this->taskData['name'] = 'newTaskName';

        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('tasks.update', ['task' => $task]), $this->taskData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $this->taskData);
    }

    public function testUpdateAsGuest(): void
    {
        $task = new Task($this->taskData);
        $task->save();
        $this->taskData['name'] = 'newTaskName2';

        $response = $this
            ->patch(route('tasks.update', ['task' => $task]), $this->taskData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $this->taskData);
    }

    public function testDestroy(): void
    {
        $task = new Task($this->taskData);
        $task = Task::factory($this->taskData)->create();

        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('tasks.destroy', ['task' => $task]));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', $this->taskData);
    }

    public function testDestroyNotByCreator(): void
    {
        $task = Task::factory($this->taskData)->create();
        $testUser = User::factory()->create();

        $response = $this
            ->actingAs($testUser)
            ->delete(route('tasks.destroy', ['task' => $task]));

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', $this->taskData);
    }
}
