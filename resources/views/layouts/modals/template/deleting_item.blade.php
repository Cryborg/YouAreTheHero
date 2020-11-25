<div>
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

    @if (isset($actions))
        <div class="card">
            <div class="card-header">
                @lang('actions.label')
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($actions as $action)
                        <li>
                            <a target="_blank" href="{{ route('page.edit', ['page' => $action->triggerable]) }}">
                                {{ $action->triggerable->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (isset($prerequisites))
        <div class="card">
            <div class="card-header">
                @lang('page.prerequisite_title')
            </div>
            <div class="card-body">
                <ul>
                @foreach ($prerequisites as $prerequisite)
                    <li>
                        <a target="_blank" href="{{ route('page.edit', ['page' => $page]) }}">
                            {{ $prerequisite->page->title }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (isset($riddles))
        <div class="card">
            <div class="card-header">
                @lang('page.riddle_header')
            </div>
            <div class="card-body">
                <ul>
                @foreach ($riddles as $riddle)
                    <li>
                        <a target="_blank" href="{{ route('page.edit', ['page' => $page]) }}">
                            {{ $riddle->page->title }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div>
        @warning({{ trans('item.deleting.confirm') }})
    </div>
</div>
