<div>
    <div class="card">
        <div class="card-header">
            @lang('item.deleting.as_page')
        </div>
        <div class="card-body">
            <ul>
                @foreach ($items as $item)
                    <li>{{ $item->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div>
        @warning({{ trans('equipment.deleting.confirm') }})
    </div>
</div>
