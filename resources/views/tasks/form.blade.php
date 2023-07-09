<div>
    {{ Form::label('name', __('Имя')) }}
</div>
<div class="mt-2">
    {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3', 'id' => 'name']) }}
</div>
<div>
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
</div>
<div>
    {{ Form::label('description', __('Описание')) }}
</div>
<div class="mt-2">
    {{ Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'cols' => 50, 'rows' => 10, 'id' => 'description']) }}
</div>
<div>
    @if ($errors->has('description'))
        <span class="error">{{ $errors->first('description') }}</span>
    @endif
</div>
<div>
    {{ Form::label('status_id', __('Статус')) }}
</div>
<div class='mt-2'>
    {{ Form::select('status_id', $statuses, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3']) }}
</div>
<div>
    @if ($errors->has('status_id'))
        <span class="error">{{ $errors->first('status_id') }}</span>
    @endif
</div>
<div>
    {{ Form::label('assigned_to_id', __('Исполнитель')) }}
</div>
<div class='mt-2'>
    {{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3', 'id' => 'assigned_to_id']) }}
</div>
<div>
    @if ($errors->has('assigned_to_id'))
        <span class="error">{{ $errors->first('assigned_to_id') }}</span>
    @endif
</div>
<div>
    {{ Form::label('labels', __('Метки')) }}
</div>
<div>
    {{ Form::select('labels[]', $allLabels, empty($selectedLabels) ? '' : $selectedLabels, ['placeholder' => '', 'multiple' => 'multiple', 'class' => 'rounded border-gray-300 w-1/3 h-32']) }}
</div>
<div>
    @if ($errors->has('labels'))
        <span class="error">{{ $errors->first('labels') }}</span>
    @endif
</div>
