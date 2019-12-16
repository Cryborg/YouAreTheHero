@if (is_array($page->filtered_choices))
    @if (count($page->filtered_choices) > 0)
        <fieldset>
            <legend>@lang('play.choices')@lang('common.:')</legend>
            <ul>
                @foreach ($page->filtered_choices as $choice)
                    <li><a href="{{ route('story.play', ['story' => $story->id, 'page' => $choice->page_to]) }}">{!! $choice->link_text !!}</a></li>
                @endforeach
            </ul>
        </fieldset>
    @else
        <div class="border border-success rounded rounded-lg p-3 text-center mb-3">
            <div class="text-bold display-4">
                GAME OVER !
            </div>
            <div class="text-muted">
                * message à personnaliser bien sûr ;)
            </div>
        </div>
    @endif
@endif
