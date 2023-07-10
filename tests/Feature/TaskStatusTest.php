<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{TaskStatus, User, Task};

class TaskStatusTest extends TestCase
{
    private User $actingUser;
    private array $dataForStoring;
    private array $dataForUpdating;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
        $this->dataForStoring = ['name' => "newTaskStatus"];
        $this->dataForUpdating = ['name' => 'updatedTaskStatus'];
    }

    public function testIndex(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('task_statuses.index'));

        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('task_statuses.create'));

        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $testLabel = TaskStatus::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('task_statuses.edit', $testLabel));

        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->post(route('task_statuses.store'), $this->dataForStoring);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'newTestStatus']);
    }

    public function testStoreAsGuest(): void
    {
        $response = $this->post(route('task_statuses.store'), $this->dataForStoring);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', $this->dataForStoring);
    }

    public function testUpdate(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('task_statuses.update', $testStatus), $this->dataForUpdating);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $this->dataForUpdating);
    }

    public function testUpdateAsGuest(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this->patch(route('task_statuses.update', $testStatus), $this->dataForUpdating);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('task_statuses', $this->dataForUpdating);
    }

    public function testDestroy(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('task_statuses.destroy', $testStatus));

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['name' => $testStatus->name]);
    }

    public function testDestroyAsGuest(): void
    {
        $testStatus = TaskStatus::factory()->create();
        $response = $this->delete(route('task_statuses.destroy', $testStatus));

        $response->assertStatus(403);
        $this->assertDatabaseHas('task_statuses', ['name' => $testStatus->name]);
    }

    public function testDestroyBoundedWithTaskStatus(): void
    {
        $testStatus = TaskStatus::factory()->has(Task::factory(), 'tasks')->create();
        $response = $this
            ->from(route('task_statuses.index'))
            ->actingAs($this->actingUser)
            ->delete(route('task_statuses.destroy', $testStatus));

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => $testStatus->name]);
    }
}
