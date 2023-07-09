<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{User, Task, Label};

class LabelTest extends TestCase
{
    private User $actingUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
    }

    public function testIndex(): Void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('labels.index'));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testCreate(): Void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('labels.create'));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testEdit(): Void
    {
        $testLabel = Label::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('labels.edit', $testLabel));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->post(route('labels.store'), ['name' => "newTestLabel"]);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'newTestLabel']);
    }

    public function testStoreAsGuest(): void
    {
        $response = $this->post(route('labels.store'), ['name' => "newTestLabel"]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('labels', ['name' => 'newTestLabel']);
    }

    public function testUpdate(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('labels.update', $testLabel), [
                'name' => "editedTestLabel"
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'editedTestLabel']);
    }

    public function testUpdateAsGuest(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this->patch(route('labels.update', $testLabel), ['name' => "editedTestLabel"]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('labels', ['name' => 'editedTestLabel']);
    }

    public function testDestroy(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->delete(route('labels.destroy', $testLabel));

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['name' => $testLabel->name]);
    }

    public function testDestroyAsGuest(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', $testLabel));

        $response->assertStatus(403);
        $this->assertDatabaseHas('labels', ['name' => $testLabel->name]);
    }

    public function testDestroyBoundedWithTaskLabel(): void
    {
        $testLabel = Label::factory()->hasTasks(1)->create();
        $response = $this
            ->from(route('labels.index'))
            ->actingAs($this->actingUser)
            ->delete(route('labels.destroy', $testLabel));

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => $testLabel->name]);
    }
}
