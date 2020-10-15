@extends('base')

@section('title', trans('common.stories_list'))

@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flip_card.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col border-bottom mb-2">
            <h5>{{ trans('stories.filters_title') }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            Languages:
            @foreach ($storiesLocales as $storyLocale)
                @if ($selectedLanguage !== $storyLocale->locale)
                    @if ($selectedLanguage === $user->locale)
                        <a class="btn btn-sm btn-grey"
                            href="{{ route('stories.list', ['language' => $storyLocale->locale]) }}">@lang('common.' . $storyLocale->locale)</a>
                    @else
                        <a class="btn btn-sm btn-grey"
                            href="{{ route('stories.list') }}">@lang('common.' . $storyLocale->locale)</a>
                    @endif
                @endif
            @endforeach
        </div>
    </div>

    {{-- Published stories --}}
    <div class="row">
        <div class="col">
            <h1>{{ trans('stories.list_published_title') }}</h1>
        </div>
    </div>

    <div class="row">
        @forelse ($stories as $story)
            @if ($story->is_published)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" style="height: 300px">
                    @include('stories.partials.story_card', ['story' => $story])
                </div>
            @endif
        @empty
            <p>Sorry, there is no story... yet! You can create yours by clicking the button below ;)</p>
            <p>
                <a href="{{ route('story.create') }}">
                    <button class="btn btn-primary">
                        <span class="icon-add"></span>
                        @lang('common.link_story_create')
                    </button>
                </a>
            </p>
        @endforelse
    </div>

    {{-- Unpublished stories --}}
    <div class="row">
        <div class="col">
            <h1 class="mt-4">{{ trans('stories.list_wip_title') }}</h1>
        </div>
    </div>

    <div class="row">
        @forelse ($stories as $story)
            @if (!$story->is_published)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" style="height: 300px">
                    @include('stories.partials.story_card', ['story' => $story])
                </div>
            @endif
        @empty
            <p>Sorry, there is no story... yet! You can create yours by clicking the button below ;)</p>
            <p>
                <a href="{{ route('story.create') }}">
                    <button class="btn btn-primary">
                        <span class="icon-add"></span>
                        @lang('common.link_story_create')
                    </button>
                </a>
            </p>
        @endforelse
    </div>
@endsection

@push('footer-scripts')
    @include('stories.js.list-js')

    <script>
        $(document).on('click touchstart keydown', '.menu-flip-card',
            function(){
                $(this).closest('.flip-card').toggleClass('flipped')
            }
        )
    </script>
@endpush
