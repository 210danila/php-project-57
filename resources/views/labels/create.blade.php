@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">@lang('Создать метку')</h1>

    {{ Form::model($label, ['route' => ['labels.store'], 'method' => 'POST']) }}
        @include('labels.form')
        <div class="mt-2">
            {{ Form::submit(__('Создать'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
        </div>
    {{ Form::close() }}
</div>

@endsection
