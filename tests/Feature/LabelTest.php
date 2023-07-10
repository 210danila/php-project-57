<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{User, Label};

class LabelTest extends TestCase
{
    private User $actingUser;
    private array $dataForStoring;
    private array $dataForUpdating;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingUser = User::factory()->create();
        $this->dataForStoring = ['name' => "newLabel"];
        $this->dataForUpdating = ['name' => 'updatedLabel'];
    }

    public function testIndex(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('labels.index'));

        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this
            ->actingAs($this->actingUser)
            ->get(route('labels.create'));

        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
    }

    public function testEdit(): void
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
            ->post(route('labels.store'), $this->dataForStoring);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $this->dataForStoring);
    }

    public function testStoreAsGuest(): void
    {
        $response = $this->post(route('labels.store'), $this->dataForStoring);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('labels', $this->dataForStoring);
    }

    public function testUpdate(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this
            ->actingAs($this->actingUser)
            ->patch(route('labels.update', $testLabel), $this->dataForUpdating);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $this->dataForUpdating);
    }

    public function testUpdateAsGuest(): void
    {
        $testLabel = Label::factory()->create();
        $response = $this->patch(route('labels.update', $testLabel), $this->dataForUpdating);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('labels', $this->dataForUpdating);
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

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => $testLabel->name]);
    }
}
