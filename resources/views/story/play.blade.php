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
        var routeContent = '{{ route('story.play', ['story' => $story->id, 'page' => $page->id]) }}';

        @include('story.js.play-js')
    </script>
@endpush
