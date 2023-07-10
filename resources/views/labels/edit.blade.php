@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">@lang('views.labels.update')</h1>

    {{ Form::model($label, ['route' => ['labels.update',  $label], 'method' => 'PATCH']) }}
        @include('labels.form')
        <div class="mt-2">
            {{ Form::submit(__('views.common.update'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
        </div>
    {{ Form::close() }}
</div>

@endsection
