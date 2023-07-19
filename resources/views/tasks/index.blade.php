@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
   <h1 class="mb-5">@lang('views.tasks.tasks')</h1>
   <div class="w-full flex items-center">
      <div>
         {{ Form::model($filters, ['route' => ['tasks.index'], 'method' => 'GET']) }}
            <div class="flex">
               <div>
                  {{ Form::select('filter[status_id]', $statuses, $filters['status_id'] ?? null, ['placeholder' => __('views.tasks.status'), 'class' => 'rounded border-gray-300']) }}
               </div>
               <div>
                  {{ Form::select('filter[created_by_id]', $users, $filters['created_by_id'] ?? null, ['placeholder' => __('views.tasks.author'), 'class' => 'ml-2 rounded border-gray-300']) }}
               </div>
               <div>
                  {{ Form::select('filter[assigned_to_id]', $users, $filters['assigned_to_id'] ?? null, ['placeholder' => __('views.tasks.performer'), 'class' => 'ml-2 rounded border-gray-300']) }}
               </div>
               <div>
                  {{ Form::submit(__('views.tasks.apply'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2'])}}
               </div>

            </div>
         {{ Form::close() }}
      </div>
      @can('create', 'App\Models\Task')
         <div class="ml-auto">
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
               @lang('views.tasks.create')            
            </a>
         </div>
      @endcan
   </div>
   <table class="mt-4">
      <thead class="border-b-2 border-solid border-black text-left">
         <tr>
            <th>ID</th>
            <th>@lang('views.tasks.status')</th>
            <th>@lang('views.tasks.name')</th>
            <th>@lang('views.tasks.author')</th>
            <th>@lang('views.tasks.performer')</th>
            <th>@lang('views.common.created_at')</th>
            @can('update', 'App\Models\Task')
               <th>@lang('views.common.actions')</th>
            @endcan
         </tr>
      </thead>
      <tbody>
         @foreach ($tasks as $task)
            <tr class="border-b border-dashed text-left">
               <td>{{ $task->id }}</td>
               <td>{{ Str::limit($task->status->name, 25) }}</td>
               <td>
                     <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                        {{ Str::limit($task->name, 50) }}
                     </a>
               </td>
               <td>{{ $task->createdBy->name }}</td>
               <td>{{ $task->assignedTo->name ?? '' }}</td>
               <td>{{ $task->created_at->format('d.m.Y') }}</td>
               <td>
                  @can('delete', $task)
                     <a data-confirm="{{ __('views.common.are_you_sure') }}" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task) }}">
                        @lang('views.common.delete')
                     </a>
                  @endcan
                  @can('update', 'App\Models\Task')
                     <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="text-blue-600 hover:text-blue-900">
                        @lang('views.common.edit')
                     </a>
                  @endcan
               </td>
            </tr>
         @endforeach
      </tbody>
   </table>
   <div>
      {{ $tasks->links() }}
   </div>
</div>

@endsection