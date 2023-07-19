@extends('layouts.app')

@section('content')

<div class="grid col-span-full">
    <h1 class="mb-5">@lang('views.labels.labels')</h1>

    <div>
        @can('create', 'App\Models\Label')
            <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                @lang('views.labels.create')
            </a>
        @endcan
    </div>

    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>@lang('views.labels.name')</th>
                <th>@lang('views.labels.description')</th>
                <th>@lang('views.common.created_at')</th>
                @can('update', 'App\Models\Label')
                    <th>@lang('views.common.actions')</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $label->id }}</td>
                    <td>{{ Str::limit($label->name, 50) }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('delete', 'App\Models\Label')
                            <a data-confirm="{{ __('views.common.are_you_sure' ) }}" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('labels.destroy', $label) }}">
                                @lang('views.common.delete')
                            </a>
                        @endcan
                        @can('update', 'App\Models\Label')
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', ['label' => $label]) }}">
                                @lang('views.common.edit')
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $labels->links() }}
     </div>
</div>
@endsection