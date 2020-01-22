<ul class="nav navbar-nav">
    <li>
        <a class="navbar-brand" href="{{ url('/stories') }}">
            <span class="glyphicon glyphicon-book mr-2"></span>
            {{ trans('common.link_reader') }}
        </a>
    </li>
    <li>
        <a href="#" data-toggle="dropdown" role="button" class="dropdown-toggle navbar-brand">
            <span class="glyphicon glyphicon-pencil mr-2"></span>
            {{ trans('common.link_author') }}
        </a>
        <ul class="dropdown-menu">
{{--            <li role="separator" class="divider"></li>--}}
            <li>
                <a href="{{ route('story.create') }}">
                    <span class="glyphicon glyphicon-plus mr-2"></span>
                    {{ trans('common.link_story_create') }}
                </a>
            </li>
            <li>
                <a href="{{ route('stories.list.draft') }}">
                    <span class="glyphicon glyphicon-paperclip mr-2"></span>
                    {{ trans('stories.link_stories_draft') }}
                </a>
            </li>
        </ul>
    </li>
    @can('isAdmin')
        <li>
            <a class="navbar-brand" href="{{ url('admin') }}">
                <span class="glyphicon glyphicon-cog mr-2"></span>
                {{ trans('common.link_admin') }}
            </a>
        </li>
    @endcan
</ul>
