<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Label;
use Database\Seeders\TaskSeeder;

class LabelSeeder extends Seeder
{
    public const FAKE_DATA = [
        ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью'],
        ['name' => 'документация', 'description' => 'Задача которая касается документации'],
        ['name' => 'дубликат', 'description' => 'Повтор другой задачи'],
        ['name' => 'доработка', 'description' => 'Новая фича, которую нужно запилить'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::FAKE_DATA as $fakeElement) {
            Label::factory($fakeElement)->create();
        }
        $next = new TaskSeeder();
        $next->run();
    }
}
