<input id="storyId" type="hidden" value="{{ $story->id }}">
<input id="pageId" type="hidden" value="{{ $page->id }}">

<div class="card shadow">
    <h5 class="card-header">
        <div class="text-center">
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

            {{ $page->present()->title }}
        </div>
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
                @foreach ($items as $index => $categories)
                    <div class="card card-no-padding">
                        <div class="card-header">
                            {{ $index }}
                        </div>
                        @foreach ($categories as $item)
                            <div class="card-body">
                                <div class="pick-item">
                                    @include('story.partials.pick-item', [
                                        'item' => $item,
                                        'icon' => 'icon-receive-money',
                                    ])
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($page->riddle()->count() > 0)
            @include('story.partials.ajax.riddle', ['data' => $page->riddle])
        @endif
    </div>
    <div class="card-body">
        <div class="btn-toolbar choices-block" role="toolbar">
        </div>
    </div>
</div>

@if ($page->is_last)
    <div class="d-flex align-items-center justify-content-center">
        <div class="card shadow mt-5">
            <div class="card-body pt-3">
                <x-rate-story :story="$story" />
            </div>

            <div class="card-body">
                <div class="choices-links button-group w-100">
                    <x-reset-button :page="$page" />
                </div>
            </div>
        </div>
    </div>
@endif

