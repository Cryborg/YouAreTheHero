@extends('base')

@section('title', trans('common.stories_list'))

@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flip_card.css') }}">
@endpush

@section('content')
    {{-- Published stories --}}
    <div class="row">
        <div class="col">
            <h1>{{ trans('stories.list_published_title') }}</h1>
        </div>
    </div>

    <div class="row" style="height: 300px">
        @forelse ($stories as $story)
            @if ($story->is_published)
                @include('stories.partials.story_card', ['stories' => $stories])
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

    <div class="row" style="height: 300px">
        @forelse ($stories as $story)
            @if (!$story->is_published)
                @include('stories.partials.story_card', ['stories' => $stories])
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
        $(document).on('click', '.menu-flip-card',
            function(){
                $(this).closest('.flip-card').toggleClass('flipped')
            }
        )
    </script>
@endpush
