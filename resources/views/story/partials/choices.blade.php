@if ($page->choices !== 'gameover')
    <fieldset>
        <legend>@lang('play.choices')@lang('common.:')</legend>
        <ul>
            @foreach ($page->choices as $choice)
                <li><a href="{{ route('story.play', ['story' => $story->id, 'page' => $choice->page_to]) }}">{!! $choice->link_text !!}</a></li>
            @endforeach
        </ul>
    </fieldset>
@endif
