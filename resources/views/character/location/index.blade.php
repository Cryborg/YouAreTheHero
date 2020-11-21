<ul>
    @foreach ($locations as $location)
        <li>
            @if ($location->page)
                <a href="{{ route('story.play', ['story' => $location->page->story, 'page' => $location->page]) }}">
            @endif
            {{ $location->name }}
            @if ($location->page)
                </a>
            @endif
        </li>
    @endforeach
</ul>
