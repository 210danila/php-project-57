@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5">Изменение статуса</h1>

    <div class="flex flex-col">
        {{ Form::model($task_status, ['route' => ['task_statuses.update', $task_status], 'method' => 'PATCH']) }}
            @include('statuses.form')
            <div class="mt-2">
                {{ Form::submit('Обновить', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
            </div>
        {{ Form::close() }}
        
    </div>
</div>
@endsection