@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{ Form::label('name', 'Имя') }}
<div class="mt-2">
    {{ Form::text('name', $task_status->name, ['class' => 'rounded border-gray-300 w-1/3', 'id' => "name"]) }}
</div>
