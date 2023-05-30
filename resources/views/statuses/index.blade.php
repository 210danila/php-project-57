@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">Статусы</h1>
    <div></div>

    <div>
        <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Создать статус
        </a>
    </div>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $task_status)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task_status->id }}</td>
                    <td>{{ $task_status->name }}</td>
                    <td>{{ $task_status->created_at }}</td>
                    <td>
                        <a data-confirm="Вы уверены?" data-method="delete" rel="nofollow" class="text-red-600 hover:text-red-900" href="{{ route('task_statuses.destroy', ['task_status' => $task_status]) }}">
                            Удалить
                        </a>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', ['task_status' => $task_status]) }}">
                            Изменить
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection