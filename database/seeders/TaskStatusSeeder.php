<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    public const FAKE_DATA = [
        ['name' => 'новый'],
        ['name' => 'в работе'],
        ['name' => 'на тестировании'],
        ['name' => 'завершен'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::FAKE_DATA as $fakeElement) {
            TaskStatus::factory($fakeElement)->create();
        }
        $next = new UserSeeder();
        $next->run();
    }
}
