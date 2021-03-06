<li class="nav-item @if (in_array(Route::current()->getName(), ['stories.list', 'story.play'])) border-menu-active @endif">
    <a class="nav-link" href="{{ url('/stories') }}">
        <span class="icon-newspaper mr-2"></span>
        {{ trans('common.link_read') }}
    </a>
</li>

<li class="nav-item dropdown @if (in_array(Route::current()->getName(), ['story.create', 'page.edit', 'stories.list.draft'])) border-menu-active @endif">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="icon-fountain-pen mr-2"></span>
        {{ trans('common.link_write') }}
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('story.create') }}">
            <span class="icon-add mr-2"></span>
            {{ trans('common.link_story_create') }}
        </a>
        <a class="dropdown-item" href="{{ route('stories.list.draft') }}">
            <span class="icon-papers mr-2"></span>
            {{ trans('stories.link_stories_draft') }}
        </a>
        @if (Route::is('page.edit'))
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('story.edit', ['story' => $page->story]) }}">
                <span class="icon-fountain-pen mr-2"></span>
                @lang('story.edit')
            </a>
        @endif
        @if (Route::is('story.edit'))
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('page.edit', ['page' => $story->getCurrentPage()->id]) }}">
                <span class="icon-fountain-pen mr-2"></span>
                @lang('story.resume_editing')
            </a>
        @endif
    </div>
</li>

@can('isAdmin')
    <li class="nav-item @if (Route::is('admin*')) border-menu-active @endif">
        <a class="nav-link" href="{{ url('admin') }}">
            <span class="icon-lightning-tear mr-2"></span>
            {{ trans('common.link_admin') }}
        </a>
    </li>
@endcan
