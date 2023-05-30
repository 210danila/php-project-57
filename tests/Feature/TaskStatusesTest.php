<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Http\Controllers\TaskStatusController;

class TaskStatusesTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_new_status(): void
    {
        $response = $this->post(route('task_statuses.store'), ['name' => "newTestStatus"]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('task_statuses', ['name' => 'newTestStatus']);
    }

    public function test_editing_status(): void
    {
        $testStatus = new TaskStatus(['name' => 'testStatusName']);
        $testStatus->save();
        $response = $this->patch(route('task_statuses.update', ['task_status' => $testStatus]), [
            'name' => "editedTestStatus"
        ]);


        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'editedTestStatus']);
    }

    public function test_destroying_status(): void
    {
        $testStatus = new TaskStatus(['name' => 'testStatusName']);
        $testStatus->save();
        $controller = new TaskStatusController();
        $controller->destroy($testStatus);
        #$response =  $this->delete(route('task_statuses.update', ['task_status' => $testStatus]));

        #$response->assertStatus(302);
        $this->assertDatabaseMissing('task_statuses', ['name' => 'testStatusName']);
    }
}
