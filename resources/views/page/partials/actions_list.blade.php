<table class="table actionsTable bg-light">
    <thead class="thead-lightblue">
        <tr>
            <th>@lang('actions.type')</th>
            <th>@lang('actions.actionable_name')</th>
            <th>@lang('actions.quantity')</th>
            <th>@lang('actions.unique')</th>
            <th>@lang('common.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($page->triggers as $trigger)
            <tr>
            <td>
                @if (($trigger->actionable instanceof \App\Models\Field) && $trigger->actionable->hidden)
                    {{ trans('item.variable') }}
                @else
                    {{ trans('item.' . $trigger->actionable_type) }}
                @endif
            </td>
            <td>
                {{ optional($trigger->actionable)->name ?? '## Error ##'}}
            </td>
            <td>{{ $trigger->quantity }}</td>
            <td>
                @if ($trigger->unique === true) @lang('common.yes') @else @lang('common.no') @endif
            </td>
            <td><span class="icon-trash text-red clickable deleteAction" data-actionid="{{ $trigger->id }}"></span></td>
            </tr>
        @endforeach
    </tbody>
</table>
