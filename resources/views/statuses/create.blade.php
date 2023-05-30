@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5">Создать статус</h1>

    {{ Form::model($task_status, ['route' => ['task_statuses.store'], 'method' => 'POST']) }}
        @include('statuses.form')
        <div class="mt-2">
            {{ Form::submit('Создать', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
        </div>
    {{ Form::close() }}
</div>
@endsection