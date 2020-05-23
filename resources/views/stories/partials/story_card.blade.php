<div class="row">
    @forelse ($stories as $story)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
            <div class="card border border-dark h-100 shadow">
                <div class="card-header p-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        {{ $story->title }}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('story.play', ['story' => $story]) }}">
                                        <span class="icon-play bg-primary rounded-circle display-6 text-white p-1 clickable mr-2"></span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon-menu-dots display-6 text-black clickable"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @if (Auth::id() === $story->user->id)
                                            <a class="dropdown-item" href="{{ route('story.edit', ['story' => $story]) }}">@lang('story.edit')</a>
                                        @endif
                                        @if (Auth::user()->hasBeganStory($story))
                                            <a class="dropdown-item" href="{{ route('story.reset', ['story' => $story]) }}">@lang('story.reset')</a>
                                        @endif
{{--                                        <div class="dropdown-divider"></div>--}}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="card-text h-75">
                        {!! $story->description !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <span class="text-muted font-smaller">
                                {{ $story->user->username }}
                            </span>
                        </div>
                        <div class="col text-right">
                            <span class="text-muted font-smaller moment_date">
                                {{ $story->updated_at }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>Sorry, there is no story... yet! You can create yours by clicking the button below ;)</p>
        <p>
            <a href="{{ route('story.create') }}">
                <button class="btn btn-primary">@lang('common.link_story_create')</button>
            </a>
        </p>
    @endforelse
</div>
