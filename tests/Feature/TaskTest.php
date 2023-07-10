<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Task, User, TaskStatus};

class TaskTest extends TestCase
{
    private User $actingUser;
    private TaskStatus $status;
    private array $dataForStoring;
    private array $dataForUpdating;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
        $this->dataForStoring = [
            'name' => 'newTask',
            'status_id' => $this->status->id,
            'created_by_id' => $this->actingUser->id
        ];
        $this->dataForUpdating = [
            'name' => 'updatedTask1',
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
            ->post(route('tasks.store'), $this->dataForStoring);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $this->dataForStoring);
    }

    public function testStoreAsGuest(): void
    {
        $response = $this
            ->post(route('tasks.store'), $this->dataForStoring);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $this->dataForStoring);
    }

    public function testUpdate(): void
    {
        $task = Task::factory($this->dataForStoring)->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('tasks.update', ['task' => $task]), $this->dataForUpdating);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $this->dataForUpdating);
    }

    public function testUpdateAsGuest(): void
    {
        $task = Task::factory($this->dataForStoring)->create();
        $response = $this
            ->patch(route('tasks.update', ['task' => $task]), $this->dataForUpdating);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', $this->dataForUpdating);
    }

    public function testDestroy(): void
    {
        $task = Task::factory($this->dataForStoring)->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('tasks.destroy', ['task' => $task]));

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', $this->dataForStoring);
    }

    public function testDestroyNotByCreator(): void
    {
        $task = Task::factory($this->dataForStoring)->create();
        $testUser = User::factory()->create();
        $response = $this
            ->actingAs($testUser)
            ->delete(route('tasks.destroy', ['task' => $task]));

        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', $this->dataForStoring);
    }
}
