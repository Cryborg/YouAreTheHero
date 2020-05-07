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
        <div class="border border-success rounded rounded-lg p-3 mb-3 mt-5">
            <div class="text-bold display-5">
                GAME OVER !
            </div>
            <div class="text-muted w-75">
                Principales causes :
                <ul>
                    <li>aucune page n'est reliée à celle-ci</li>
                    <li>aucune page n'est accessible car il te manque les prérequis pour y accéder</li>
                </ul>
            </div>
        </div>
    @endif
@endif

@if (is_array($page->unreachable_choices))
    @if (count($page->unreachable_choices) > 0)
        <div class="choices-links button-group w-100">
            @foreach ($page->unreachable_choices as $choice)
                <button class="large button" disabled>{!! $choice->link_text !!}</button>
            @endforeach
        </div>
    @endif
@endif

@if ($page->is_last)
    <div class="border border-success rounded rounded-lg p-3 text-center mb-3 mt-5">
        <div class="text-bold display-5">
            GAME OVER !
        </div>
        <div class="text-muted">
            Cause : cette page est tagguée comme étant la dernière
        </div>
    </div>
@endif
