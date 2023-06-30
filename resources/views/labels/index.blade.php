@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">Метки</h1>

    <div>
        @can('label')
            <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Создать метку
            </a>
        @endcan
    </div>

    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('label')
                            {{ Form::open(['method' => 'POST', 'route' => ['labels.destroy', $label], 'style' => "display: none;", 'id' => "delete-form-$label->id"]) }}
                                @csrf
                                @method('delete')
                            {{ Form::close() }}
                            <a href="{{ route('labels.destroy', $label) }}" rel="nofollow" onclick="event.preventDefault(); if (confirm(this.getAttribute('data-confirm'))) { document.getElementById('delete-form-{{ $label->id }}').submit(); }" class="text-red-600 hover:text-red-900">
                                Удалить
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', ['label' => $label]) }}">
                                Изменить
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection