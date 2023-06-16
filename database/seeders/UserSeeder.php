<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\LabelSeeder;

class UserSeeder extends Seeder
{
    public const USERS_COUNT = 15;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($id = 1; $id <= self::USERS_COUNT; $id++) {
            User::factory()->create();
        }
        User::factory([
            'name' => 'me',
            'email' => 'me@gmail.com',
            'password' => Hash::make('11111111')
        ])->create();
        $next = new LabelSeeder();
        $next->run();
    }
}
