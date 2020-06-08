@extends('layouts.' . $layout)

@section('title', $title)

@section('map')
    @foreach ($visitedPlaces as $place)
        <a href="{{ route('story.play', ['story' => $story->id, 'page' => $place->page_id]) }}">{{ $place->page_title }}</a><br>
    @endforeach
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var pageId = {{ $page->id }};

        var routeInventory = '{{ route('story.inventory', ['story' => $story->id]) }}';
        var routeSheet = '{{ route('story.sheet', ['story' => $story->id]) }}';
        var routeChoices = '{{ route('page.choices', ['page' => $page->id]) }}';
        var routeContent = '{{ route('story.play', ['story' => $story->id, 'page' => $page->id]) }}';

        var saveSuccessHeading = "{!! trans('notification.save_success_title') !!}";
        var saveSuccessText = "{!! trans('notification.save_success_text') !!}";
        var saveFailedHeading = "{!! trans('notification.save_failed_title') !!}";
        var saveFailedText = "{!! trans('notification.save_failed_text') !!}";

        @include('story.js.play-js')
    </script>
@endpush
