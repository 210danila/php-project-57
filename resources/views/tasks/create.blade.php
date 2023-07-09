@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5">@lang('Создать задачу')</h1>

    {{ Form::model($task, ['route' => ['tasks.store'], 'method' => 'POST'])}}
        <div class="flex flex-col">
            @include('tasks.form')
            <div class='mt-2'>
                {{ Form::submit(__('Создать'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'])}}
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection