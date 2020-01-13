<table class="table" id="actions_list">
    <thead class="thead-light">
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.verb') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col">{{ trans('item.price') }}</th>
        <th scope="col">{{ trans('common.actions') }}</th>
    </thead>
    @foreach ($page->prerequisites() ?? [] as $prerequisite)
        @foreach ($prerequisite->items ?? [] as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->present()->verb }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td class="text-center">
                    <span class="glyphicon glyphicon-trash" data-action_id="{{ $prerequisite->id }}" title="{{ trans('admin.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
