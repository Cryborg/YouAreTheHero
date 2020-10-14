<a onclick="return confirm('{{ addslashes(trans('story.reset_story_confirm')) }}');" href="{{ route('story.reset', ['story' => $page->story]) }}">
    <button class="btn btn-danger card-link w-100 mb-1" data-original-text="{{ trans('story.reset') }}">{{ trans('story.reset') }}</button>
</a>
