<h3>{{ trans('item.items_title') }}</h3>
<table class="table" id="actions_list">
    <thead class="thead-light">
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.verb') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col">{{ trans('item.price') }}</th>
        <th scope="col" class="text-center">{{ trans('common.actions') }}</th>
    </thead>
    <tbody>
        @foreach ($page->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ trans('actions.' . $item->pivot->verb) }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>{{ $item->pivot->price }}</td>
                <td class="text-center">
                    <span class="glyphicon glyphicon-trash text-danger delete-action" data-action_id="{{ $item->pivot->id }}" title="{{ trans('common.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
