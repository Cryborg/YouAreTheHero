<div class="row">
    <div class="col">
        <ul>
            @foreach($caracteristics as $name => $value)
                <li>{{ $name }} : {{ $value }}</li>
            @endforeach
        </ul>
    </div>
</div>
