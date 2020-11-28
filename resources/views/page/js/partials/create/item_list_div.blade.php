<table class="datatable w-100 table-striped table-hover">
    <thead>
        <tr>
            <th>@lang('item.name')</th>
            <th>@lang('item.price')</th>
            <th>@lang('item.is_unique')</th>
            <th>@lang('item.size')</th>
            <th>@lang('common.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td class="w-25">
                    {{ $item->name }}
                </td>
                <td>
                    {!! $item->present()->price !!}
                </td>
                <td>
                    @if ($item->is_unique) @lang('common.yes') @else @lang('common.no') @endif
                </td>
                <td>
                    {{ $item->size }}
                </td>
                <td>
                    <span class="btn btn-outline-danger btnDeleteItem" data-itemid="{{ $item->id }}"><span class="icon-trash text-red"></span></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
