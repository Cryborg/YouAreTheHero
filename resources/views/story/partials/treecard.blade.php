<div class="row flex-row flex-nowrap">
    @foreach($pages as $page)
        <div class="col" id="{{ $page->uuid }}">
            <div class="row">
                <div class="col-1">
                    <div class="card x-small" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $page->title }}</h5>
                            @if ($page->is_checkpoint)
                                <h6 class="card-subtitle mb-2 text-muted">{{ trans('model.is_checkpoint') }}</h6>
                            @endif

                            <p class="card-text">{!! \Illuminate\Support\Str::limit($page->content, 200, $end='...') !!}</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col children_pages is_empty" id="children_pages_{{ $page->uuid }}" data-pageid="{{ $page->uuid }}"></div>
            </div>
        </div>
    @endforeach
</div>
