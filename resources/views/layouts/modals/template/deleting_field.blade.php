<div>
    @if (isset($prerequisites))
        <div class="card">
            <div class="card-header">
                @lang('page.prerequisite_title')
            </div>
            <div class="card-body">
                <ul>
                @foreach ($prerequisites as $prerequisite)
                    <li>
                        <a target="_blank" href="{{ route('page.edit', ['page' => $prerequisite->page]) }}">
                            {{ $prerequisite->page->title }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (isset($items))
        <div class="card">
            <div class="card-header">
                @lang('item.item')
            </div>
            <div class="card-body">
                <ul>
                @foreach ($items as $item)
                    <li>{{ $item->name }}</li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (isset($pages))
        <div class="card">
            <div class="card-header">
                @lang('common.title_pages')
            </div>
            <div class="card-body">
                <ul>
                @foreach ($pages as $page)
                    <li>
                        <a target="_blank" href="{{ route('page.edit', ['page' => $page]) }}">
                            {{ $page->title }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div>
        @warning({{ trans('field.deleting_field.confirm') }})
    </div>
</div>
