@foreach ($items as $item)
    <div class="border border-light highlight-hover">
        <div>
            {{ $item->name }}
        </div>
        <div class="select-subtext">
            <div class="text-muted pl-2">
                <span class="mr-2">
                    <i>@lang('item.price'):</i> {!! $item->present()->price !!}
                </span> <span class="mr-2">
                    <i>@lang('item.single_use'):</i> @if ($item->single_use) @lang('common.yes') @else @lang('common.no') @endif
                </span> <span>
                    <i>@lang('item.size'):</i> {{ $item->size }}
                </span>
            </div>
        </div>
    </div>
@endforeach
