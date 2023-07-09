@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
   <h1 class="mb-5">@lang('Задачи')</h1>
   <div class="w-full flex items-center">
      <div>
         {{ Form::model($filterQueries, ['route' => ['tasks.index'], 'method' => 'GET']) }}
            <div class="flex">
               <div>
                  {{ Form::select('filter[status_id]', $statuses, $filterQueries['status_id'] ?? null, ['placeholder' => 'Статус', 'class' => 'rounded border-gray-300']) }}
               </div>
               <div>
                  {{ Form::select('filter[created_by_id]', $users, $filterQueries['created_by_id'] ?? null, ['placeholder' => 'Автор', 'class' => 'ml-2 rounded border-gray-300']) }}
               </div>
               <div>
                  {{ Form::select('filter[assigned_to_id]', $users, $filterQueries['assigned_to_id'] ?? null, ['placeholder' => 'Исполнитель', 'class' => 'ml-2 rounded border-gray-300']) }}
               </div>
               <div>
                  {{ Form::submit('Применить', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2'])}}
               </div>

            </div>
         {{ Form::close() }}
      </div>
      @can('create', 'App\Models\Task')
         <div class="ml-auto">
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
               @lang('Создать задачу')            
            </a>
         </div>
      @endcan
   </div>
   <table class="mt-4">
      <thead class="border-b-2 border-solid border-black text-left">
         <tr>
            <th>@lang('ID')</th>
            <th>@lang('Статус')</th>
            <th>@lang('Имя')</th>
            <th>@lang('Автор')</th>
            <th>@lang('Исполнитель')</th>
            <th>@lang('Дата создания')</th>
            @can('update', 'App\Models\Task')
               <th>@lang('Действия')</th>
            @endcan
         </tr>
      </thead>
      <tbody>
         @foreach ($tasks as $task)
            <tr class="border-b border-dashed text-left">
               <td>{{ $task->id }}</td>
               <td>{{ $task->status->name }}</td>
               <td>
                     <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                     {{ $task->name }}
                     </a>
               </td>
               <td>{{ $task->createdBy->name }}</td>
               <td>{{ $task->assignedTo->name ?? '' }}</td>
               <td>{{ $task->created_at->format('d.m.Y') }}</td>
               <td>
                  @can('delete', $task)
                     <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task) }}">
                        @lang('Удалить')
                     </a>
                  @endcan
                  @can('update', 'App\Models\Task')
                     <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="text-blue-600 hover:text-blue-900">
                        @lang('Изменить')
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