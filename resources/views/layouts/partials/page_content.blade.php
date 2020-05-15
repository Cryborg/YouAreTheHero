<div class="col col-xs-12" id="page_content">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            @can('edit', $page)
                <a href="{{ route('page.edit', ['page' => $page]) }}" target="_blank" class="pull-left">
                    <button>
                        <span class="icon-fountain-pen display-6"></span>
                    </button>
                </a>
            @endcan

            {{ $page->title }}
        </div>
        <div class="panel-body text-justify">
            {!! $page->present()->content !!}
        </div>

        <div class="panel-body">
            <div class="row mt-3">
                <div class="col-xl-6 col-md-12">
                    @foreach ($actions as $action)
                        @switch($action->pivot->verb)
                            @case ('buy')
                            @case ('take')
                            @case ('sell')
                            @case ('give')
                            <div class="pick-item" data-actionid="{{ $action->pivot->id }}">
                                @include('story.partials.money', [
                                    'value' => $action->pivot->price,
                                    'icon' => in_array($action->pivot->verb, ['sell','give']) ? 'icon-receive-money' : 'icon-pay-money',
                                    'name' => $action->name
                                ])
                                {{--                    @if ($action['item']->effects)--}}
                                {{--                        @foreach ($action['item']->effects as $effect => $value)--}}
                                {{--                            @include('story.partials.effects', [--}}
                                {{--                                'name' => $effect,--}}
                                {{--                                'value' => $value['quantity'],--}}
                                {{--                                'operator' => $value['operator'] === '+' ? 'add' : 'sub'--}}
                                {{--                            ])--}}
                                {{--                        @endforeach--}}
                                {{--                    @endif--}}
                            </div>
                            @break
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
        <div class="panel-body">
            @if ($page->riddle()->count() > 0)
                @include('story.partials.riddle', ['data' => $page->riddle])
            @endif
        </div>
        <div class="panel-body">
            @include('story.partials.choices', ['page' => $page, 'story' => $story])
        </div>
    </div>
</div>
