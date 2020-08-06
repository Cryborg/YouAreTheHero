<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2 h-100">
    <div class="card flip-card border border-dark h-100 shadow">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <div class="card-header p-0 h-25">
                    <nav class="navbar navbar-expand navbar-light bg-light navbar-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent{{ $story->id }}" aria-controls="navbarSupportedContent{{ $story->id }}" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        {{ $story->title }}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent{{ $story->id }}">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('story.play', ['story' => $story]) }}" title="@lang('story.start_playing')">
                                        <span class="icon-play bg-primary rounded-circle display-6 text-white p-1 clickable mr-2"></span>
                                    </a>
                                </li>
                                @if (Auth::id() === $story->author->id)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="icon-menu-dots display-6 text-black clickable"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right shadow-lg">
                                            {{-- Edit story--}}
                                            <a class="dropdown-item" href="{{ route('story.edit', ['story' => $story]) }}">
                                                <span class="icon-settings mr-2"></span>
                                                @lang('story.edit')
                                            </a>

                                            {{-- Resume page editing --}}
                                            <a class="dropdown-item" href="{{ route('page.edit', ['page' => $story->getCurrentPage()->id]) }}">
                                                <span class="icon-fountain-pen mr-2"></span>
                                                @lang('story.resume_editing')
                                            </a>

                                            @if (Auth::user()->hasBeganStory($story))
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('story.reset', ['story' => $story]) }}">
                                                    <span class="icon-recycle text-red mr-2"></span>
                                                    @lang('story.reset')
                                                </a>
                                            @endif

                                            {{-- Show story statistics --}}
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item menu-flip-card clickable">
                                                <span class="icon-statistics text-black mr-2"></span>
                                                @lang('story.show_statistics')
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="card-body h-50">
                    <div class="card-text">
                        {!! $story->description !!}
                    </div>
                </div>
                <div class="card-footer h-25">
                    <div class="row">
                        <div class="col">
                            <span class="badge badge-success bottom-right p-1 pl-2 pr-2">
                                {{ trans_choice('story.words_count', $story->wordsCount) }} /
                                {{ trans_choice('story.pages_count', $story->pages()->count()) }}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @foreach ($story->genres as $genre)
                                <span class="badge badge-primary mr-1 p-1">{{ $genre->label }}</span>
                            @endforeach
                        </div>
                    </div>
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
            <div class="flip-card-back">
                <button type="button" class="close menu-flip-card text-white p-2">
                    <span aria-hidden="true">×</span>
                </button>
                Bouh
            </div>
        </div>
    </div>
</div>
