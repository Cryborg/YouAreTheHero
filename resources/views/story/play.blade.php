@extends('layouts.' . $layout)

@section('title', $title)

@section('map')
    @foreach ($visitedPlaces as $place)
        <a href="{{ route ('story.play', ['story' => $story->id, 'page' => $place->page_id]) }}">{{ $place->title }}</a><br>
    @endforeach
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var pageId = {{ $page->id }};

        var routePurse = '{{ route('character.purse', ['character' => $character->id]) }}';
        var routeInventory = '{{ route('story.inventory', ['story' => $story->id]) }}';
        var routeSheet = '{{ route('story.sheet', ['story' => $story->id]) }}';

        @include('story.js.play-js')
    </script>
@endpush
