@if ($page->choices !== 'gameover')
    <fieldset>
        <legend>@lang('play.choices')@lang('common.:')</legend>
        <ul>
            @foreach ($page->choices as $choice)
                <li><a href="{{ url('story/' . $story->id . '/' . $choice->page_to) }}">{!! $choice->link_text !!}</a></li>
            @endforeach
        </ul>
    </fieldset>
@endif
