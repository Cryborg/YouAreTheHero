@if ($sheet)
    <div class="row">
        <div class="col">
            <ul>
                @foreach($sheet as $stat)
                    <li>{{ $stat->stat_name }} : {{ $stat->stat_value }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
