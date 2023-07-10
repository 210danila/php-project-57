{{ Form::label('name', __('views.labels.name')) }}
<div class="mt-2">
    {{ Form::text('name', $label->name, ['class' => 'rounded border-gray-300 w-1/3', 'id' => "name"]) }}
</div>
<div>
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
</div>
{{ Form::label('description', __('views.labels.description')) }}
<div class="mt-2">
    {{ Form::textarea('description', $label->description, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'id' => "description"]) }}
</div>
<div>
    @if ($errors->has('description'))
        <span class="error">{{ $errors->first('description') }}</span>
    @endif
</div>
