<ul class="nav navbar-nav">
    <li>
        <a class="navbar-brand" href="{{ url('/stories') }}">
            @lang('common.link_stories')
        </a>
    </li>
    <li>
        <a href="#" data-toggle="dropdown" role="button" class="dropdown-toggle navbar-brand">
            @lang('common.link_admin')
        </a>
        <ul class="dropdown-menu">
{{--            <li>--}}
{{--                <a href="{{ url('/admin') }}">--}}
{{--                    @lang('common.link_admin')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li role="separator" class="divider"></li>--}}
            <li>
                <a href="{{ route('story.create') }}">
                    {{ trans('common.link_story_create') }}
                </a>
            </li>
            <li>
                <a href="{{ route('stories.list.draft') }}">
                    {{ trans('stories.link_stories_draft') }}
                </a>
            </li>
        </ul>
    </li>
</ul>
