@if ($page->riddle && $page->riddle->isSolved($character))
    @if ($page->riddle->target_page_id)
        <div class="choices-links button-group w-100">
            <div class="col-md-12 col-xl-6">
                <a data-href="{{ route('story.play', ['story' => $page->story->id, 'page' => $page->riddle->target_page_id]) }}">
                    <button class="large button w-100">{!! $page->riddle->target_page_text !!}</button>
                </a>
            </div>
        </div>
    @endif
@endif

@if (is_array($page->filtered_choices))
    @if (count($page->filtered_choices) > 0)
        <div class="choices-links button-group w-100">
            <div class="col-md-12 col-xl-6">
                @foreach ($page->filtered_choices as $choice)
                    <a data-href="{{ route('story.play', ['story' => $page->story->id, 'page' => $choice->page_to]) }}" data-page-id="{{ $choice->page_to }}">
                        <button class="large button w-100" data-original-text="{!! $choice->present()->link_text !!}">{!! $choice->present()->link_text !!}</button>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endif

@if (is_array($page->unreachable_choices))
    @if (count($page->unreachable_choices) > 0)
        <div class="choices-links button-group w-100">
            <div class="col-md-12 col-xl-6">
                @foreach ($page->unreachable_choices as $choice)
                    @if (!$choice->hidden)
                        <button class="large button w-100" disabled>{!! $choice->present()->link_text !!}</button>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endif
