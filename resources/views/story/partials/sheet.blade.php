@if ($sheet)
    <div class="row">
        <div class="col">
            <ul>
                @foreach($sheet as $stat)
                    @if ($stat->stat_story)
                        <li>{{ $stat->stat_story->full_name }} : {{ $stat->value }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
