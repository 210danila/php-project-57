@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">@lang('views.statuses.statuses')</h1>

    <div>
        @can('create', 'App\Models\TaskStatus')
            <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                @lang('views.statuses.create')
            </a>
        @endcan
    </div>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>@lang('views.statuses.name')</th>
                <th>@lang('views.common.created_at')</th>
                @can('update', 'App\Models\TaskStatus')
                    <th>@lang('views.common.actions')</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $task_status)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task_status->id }}</td>
                    <td>{{ Str::limit($task_status->name, 50) }}</td>
                    <td>{{ $task_status->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('delete', 'App\Models\TaskStatus')
                            <a data-confirm="{{ __('views.common.are_you_sure') }}" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('task_statuses.destroy', $task_status) }}">
                                @lang('views.common.delete')
                            </a>
                        @endcan
                        @can('update', 'App\Models\TaskStatus')
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', ['task_status' => $task_status]) }}">
                                @lang('views.common.edit')
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