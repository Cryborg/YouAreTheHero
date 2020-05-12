@if ($sheet)
    <div class="row">
        <div class="col">
            <ul>
                @foreach($sheet as $stat)
                    @if ($stat->field)
                        <li>{{ $stat->field->full_name }} : {{ $stat->value }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
