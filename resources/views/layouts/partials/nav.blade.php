<li class="nav-item">
    <a class="nav-link" href="{{ url('/stories') }}">
        <span class="icon-newspaper mr-2"></span>
        {{ trans('common.link_read') }}
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="icon-fountain-pen mr-2"></span>
        {{ trans('common.link_write') }}
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('story.create') }}">
            {{ trans('common.link_story_create') }}
        </a>
        <a class="dropdown-item" href="{{ route('stories.list.draft') }}">
            {{ trans('stories.link_stories_draft') }}
        </a>
    </div>
</li>
@can('isAdmin')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('admin') }}">
            <span class="icon-lightning-tear mr-2"></span>
            {{ trans('common.link_admin') }}
        </a>
    </li>
@endcan
