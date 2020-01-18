@if ($sheet)
    <div class="row">
        <div class="col">
            <ul>
                @foreach($sheet as $stat)
                    <li>{{ $stat->stat_story->full_name }} : {{ $stat->value }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
