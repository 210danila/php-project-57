<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('task_statuses')->insert([
            ['name' => 'новый', 'created_at' => Carbon::now()],
            ['name' => 'в работе', 'created_at' => Carbon::now()],
            ['name' => 'на тестировании', 'created_at' => Carbon::now()],
            ['name' => 'завершен', 'created_at' => Carbon::now()]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Пономарёва Альбина Фёдоровна',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password1'),
            ],
            [
                'name' => 'Белоусов Александр Алексеевич',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password2'),
            ],
            [
                'name' => 'Баранов Август Евгеньевич',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password3'),
            ],
            [
                'name' => 'Лилия Фёдоровна Власоваа',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password4'),
            ],
            [
                'name' => 'Егорова Кузьма Андреевич',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password5'),
            ],
            [
                'name' => 'Галкинаа Флорентина Андреевна',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password6'),
            ],
            [
                'name' => 'Тетерин Викентий Дмитриевич',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password7'),
            ],
            [
                'name' => 'Платон Львович Миронов',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password8'),
            ],
            [
                'name' => 'Никонов Ростислав Алексеевич',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password9'),
            ],
            [
                'name' => 'Агафонова Клара Львовна',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password10'),
            ],
            [
                'name' => 'Дроздов Артём Евгеньевич',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password11'),
            ],
            [
                'name' => 'Данилова Жанна Дмитриевна',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password12'),
            ],
            [
                'name' => 'Тит Борисович Воронцова',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password13'),
            ],
            [
                'name' => 'Беспаловаа Алла Фёдоровна',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password14'),
            ],
            [
                'name' => 'Милан Алексеевич Емельянов',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password15'),
            ],
            [
                'name' => 'me',
                'email' => 'me@gmail.com',
                'password' => Hash::make('11111111')
            ],
        ]);

        DB::table('tasks')->insert([
            'name' => 'Исправить ошибку в какой-нибудь строке',
            'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            'status_id' => 4,
            'created_by_id' => 5,
            'assigned_to_id' => 8,
            'created_at' => Carbon::now()
        ]);

        DB::table('labels')->insert([
            ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью', 'created_at' => Carbon::now()],
            ['name' => 'документация', 'description' => 'Задача которая касается документации', 'created_at' => Carbon::now()],
            ['name' => 'дубликат', 'description' => 'Повтор другой задачи', 'created_at' => Carbon::now()],
            ['name' => 'доработка', 'description' => 'Новая фича, которую нужно запилить', 'created_at' => Carbon::now()],
        ]);
    }
}
