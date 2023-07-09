{{ Form::label('name', __('Имя')) }}
<div class="mt-2">
    {{ Form::text('name', $task_status->name, ['class' => 'rounded border-gray-300 w-1/3', 'id' => "name"]) }}
</div>
<div>
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
</div>
