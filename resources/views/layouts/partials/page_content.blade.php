<div class="col col-xs-12" id="page_content">
    <div class="card">
        <h5 class="card-header text-center">
            @can('edit', $page)
                <a href="{{ route('page.edit', ['page' => $page]) }}" target="_blank" class="pull-left">
                    <button>
                        <span class="icon-fountain-pen display-6"></span>
                    </button>
                </a>
            @endcan

            @can('debug')
                <span class="badge badge-warning"><span class="font-smaller">#</span>{{ $page->id }}</span>
            @endcan

            {{ $page->title }}
        </h5>
        @if ($messages)
            <div class="card-body">
                <div class="card-text">
                    @foreach($messages as $message)
                        <div class="alert alert-{{ $message['type'] }} alert-dismissible fade show" role="alert">
                            {{ $message['text'] }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="card-body text-justify">
            {!! $page->present()->content !!}
        </div>

        <div class="card-body">
            <div class="row mt-3">
                <div class="col-xl-6 col-md-12">
                    @foreach ($items as $item)
                        @switch($item->pivot->verb)
                            @case ('buy')
                            @case ('take')
                            @case ('sell')
                            @case ('give')
                            <div class="pick-item">
                                @include('story.partials.pick-item', [
                                    'item' => $item,
                                    'icon' => in_array($item->pivot->verb, ['sell','give']) ? 'icon-receive-money' : 'icon-pay-money',
                                ])
                                @if ($item->effects)
                                    @foreach ($item->effects as $effect => $value)
                                        @include('story.partials.effects', [
                                            'name' => $effect,
                                            'value' => $value['quantity'],
                                            'operator' => $value['operator'] === '+' ? 'add' : 'sub'
                                        ])
                                    @endforeach
                                @endif
                            </div>
                            @break
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($page->riddle()->count() > 0)
                @include('story.partials.riddle', ['data' => $page->riddle])
            @endif
        </div>
        <div class="card-body">
            @include('story.partials.choices', ['page' => $page, 'story' => $story])
        </div>
    </div>
</div>
