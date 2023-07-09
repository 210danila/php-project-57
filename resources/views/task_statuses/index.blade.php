@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">@lang('Статусы')</h1>

    <div>
        @can('create', 'App\Models\TaskStatus')
            <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                @lang('Создать статус')
            </a>
        @endcan
    </div>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>@lang('ID')</th>
                <th>@lang('Имя')</th>
                <th>@lang('Дата создания')</th>
                @can('status')
                    <th>@lang('Действия')</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $task_status)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task_status->id }}</td>
                    <td>{{ $task_status->name }}</td>
                    <td>{{ $task_status->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('delete', 'App\Models\TaskStatus')
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('task_statuses.destroy', $task_status) }}">
                                @lang('Удалить')
                            </a>
                        @endcan
                        @can('update', 'App\Models\TaskStatus')
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', ['task_status' => $task_status]) }}">
                                @lang('Изменить')
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $statuses->links() }}
     </div>
</div>
@endsection