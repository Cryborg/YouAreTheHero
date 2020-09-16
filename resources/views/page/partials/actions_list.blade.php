<table class="table actionsTable bg-light">
    <thead class="thead-lightblue">
        <tr>
            <th>@lang('actions.type')</th>
            <th>@lang('actions.actionable_name')</th>
            <th>@lang('actions.quantity')</th>
            <th>@lang('common.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($page->triggers as $trigger)
            <tr>
            <td>@if ($trigger->actionable_type === 'item') @lang('actions.item') @else @lang('actions.field') @endif</td>
            <td>{{ $trigger->actionable->name }}</td>
            <td>{{ $trigger->quantity }}</td>
            <td><span class="icon-trash text-red clickable deleteAction" data-actionid="{{ $trigger->id }}"></span></td>
            </tr>
        @endforeach
    </tbody>
</table>
