@if ($errors->any()) :
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>
    {{ Form::label('name', 'Имя') }}
</div>
<div class="mt-2">
    {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3', 'id' => 'name']) }}
</div>
<div>
    {{ Form::label('description', 'Описание') }}
</div>
<div class="mt-2">
    {{ Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'cols' => 50, 'rows' => 10, 'id' => 'description']) }}
</div>
<div>
    {{ Form::label('status_id', 'Статус') }}
</div>
<div class='mt-2'>
    {{ Form::select('status_id', $statuses, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3']) }}
</div>
<div>
    {{ Form::label('assigned_to_id', 'Исполнитель') }}
</div>
<div class='mt-2'>
    {{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3', 'id' => 'assigned_to_id']) }}
</div>
<div>
    {{ Form::label('labels', 'Метки') }}
</div>
<div>
    {{ Form::select('labels[]', $allLabels, empty($selectedLabels) ? '' : $selectedLabels, ['placeholder' => '', 'multiple' => 'multiple', 'class' => 'rounded border-gray-300 w-1/3 h-32']) }}
</div>
