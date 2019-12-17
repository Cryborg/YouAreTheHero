<table class="table table-striped" id="actions_list">
    <thead>
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.verb') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col">{{ trans('item.price') }}</th>
        <th scope="col">{{ trans('common.actions') }}</th>
    </thead>
    @foreach ($page->actions as $action)
        <tr>
            <td>{{ $action->item->name }}</td>
            <td>{{ trans('actions.' . $action->verb) }}</td>
            <td>{{ $action->quantity }}</td>
            <td>{{ $action->price }}</td>
            <td class="text-center">
                <span class="glyphicon glyphicon-trash" data-action_id="{{ $action->id }}"></span>
            </td>
        </tr>
    @endforeach
</table>
