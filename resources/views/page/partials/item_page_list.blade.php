<table class="table">
    <thead class="thead-lightblue">
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col">{{ trans('item.price') }}</th>
        <th scope="col" class="text-center">{{ trans('common.actions') }}</th>
    </thead>
    <tbody class="alternate-rows-colors">
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>{{ $item->pivot->price }}</td>
                <td class="text-center">
                    <span class="icon-trash text-danger deleteItemPage" data-itemid="{{ $item->id }}" title="{{ trans('common.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
