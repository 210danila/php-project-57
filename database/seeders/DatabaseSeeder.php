<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('task_statuses')->insert([
            ['name' => 'новый', 'created_at' => Carbon::now()],
            ['name' => 'в работе', 'created_at' => Carbon::now()],
            ['name' => 'на тестировании', 'created_at' => Carbon::now()],
            ['name' => 'завершен', 'created_at' => Carbon::now()]
        ]);
    }
}
