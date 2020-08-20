<div class="btn-toolbar choices-block" role="toolbar">
    @if ($page->riddle && $page->riddle->isSolved())
        @if ($page->riddle->target_page_id)
            <a data-href="{{ route('story.play', ['story' => $page->story->id, 'page' => $page->riddle->target_page_id]) }}">
                <button class="large button">{!! $page->riddle->target_page_text !!}</button>
            </a>
        @endif
    @endif

    @if (is_array($page->filtered_choices))
        @if (count($page->filtered_choices) > 0)
            <div class="choices-links button-group">
                @foreach ($page->filtered_choices as $choice)
                    <a data-href="{{ route('story.play', ['story' => $page->story->id, 'page' => $choice->page_to]) }}" data-page-id="{{ $choice->page_to }}">
                        <button class="large button" data-original-text="{!! $choice->link_text !!}">{!! $choice->link_text !!}</button>
                    </a>
                @endforeach
            </div>
        @else
            @if (!$page->is_last && (!$page->riddle || ($page->riddle && !$page->riddle->target_page_id)))
                <div class="border border-success rounded rounded-lg p-3 mb-3 mt-5">
                    <div class="text-bold display-5">
                        IMPASSE !
                    </div>
                    <div class="text-muted w-75">
                        Cela ne devrait pas arriver, l'auteur s'est bien planté ;)<br> Principales causes :
                        <ul>
                            <li>aucune page n'est reliée à celle-ci</li>
                            <li>aucune page n'est accessible car il te manque les prérequis pour y accéder</li>
                        </ul>
                    </div>
                </div>
                @can('isAdmin')
                    <div class="choices-links button-group w-100">
                        <a onclick="return confirm('{{ addslashes(trans('story.reset_story_confirm')) }}');" href="{{ route('story.reset', ['story' => $page->story]) }}"><button class="btn btn-danger card-link w-100 mb-1" data-original-text="{{ trans('story.reset') }}">{{ trans('story.reset') }}</button></a>
                    </div>
                @endcan
            @endif
        @endif
    @endif

    @if (is_array($page->unreachable_choices))
        @if (count($page->unreachable_choices) > 0)
            <div class="choices-links button-group">
                @foreach ($page->unreachable_choices as $choice)
                    @if (!$choice->hidden)
                        <button class="large button" disabled>{!! $choice->link_text !!}</button>
                    @endif
                @endforeach
            </div>
        @endif
    @endif
</div>

@if ($page->is_last)
    <div class="border border-success rounded rounded-lg p-3 text-center mb-3 mt-5">
        <div class="text-bold display-5">
            GAME OVER !
        </div>
    </div>
    <div class="choices-links button-group w-100">
        <a onclick="return confirm('{{ addslashes(trans('story.reset_story_confirm')) }}');" href="{{ route('story.reset', ['story' => $page->story]) }}"><button class="btn btn-danger card-link w-100 mb-1" data-original-text="{{ trans('story.reset') }}">{{ trans('story.reset') }}</button></a>
    </div>
@endif
