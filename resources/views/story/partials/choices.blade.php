@if (is_array($page->filtered_choices))
    @if (count($page->filtered_choices) > 0)
        <div class="choices-links button-group w-100">
            @foreach ($page->filtered_choices as $choice)
                <a href="{{ route('story.play', ['story' => $story->id, 'page' => $choice->page_to]) }}">
                    <button class="large button">{!! $choice->link_text !!}</button>
                </a>
            @endforeach
            @if ($page->riddle && $page->riddle->isSolved())
                @if ($page->riddle->target_page)
                    <a href="{{ route('story.play', ['story' => $story->id, 'page' => $page->riddle->target_page]) }}">
                        <button class="large button">{!! $page->riddle->target_text !!}</button>
                    </a>
                @endif
            @endif
        </div>
    @else
        <div class="border border-success rounded rounded-lg p-3 text-center mb-3 mt-5">
            <div class="text-bold display-4">
                GAME OVER !
            </div>
            <div class="text-muted">
                * message à personnaliser bien sûr ;)
            </div>
        </div>
    @endif
@endif
