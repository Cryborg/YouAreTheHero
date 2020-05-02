<h3>{{ trans('item.items_title') }}</h3>
<table class="table" id="actions_list">
    <thead class="thead-light">
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.verb') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col">{{ trans('item.price') }}</th>
        <th scope="col">{{ trans('common.actions') }}</th>
    </thead>
    <tbody>
        @foreach ($page->actions as $action)
            <tr>
                <td>{{ $action->item->name }}</td>
                <td>{{ $action->present()->verb }}</td>
                <td>{{ $action->quantity }}</td>
                <td>{{ $action->price }}</td>
                <td class="text-center">
                    <span class="glyphicon glyphicon-trash-red delete-action" data-action_id="{{ $action->id }}" title="{{ trans('common.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
