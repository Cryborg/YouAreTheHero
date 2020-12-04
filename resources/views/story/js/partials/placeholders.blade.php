@foreach($placeholders ?? [] as $role => $placeholder)
    @if (!is_array($placeholder))
        <div class="p-2 clickable highlight-hover w-100" data-value="{{ $role }}">{{ $placeholder }}</div>
    @else
        <div class="p-2 w-100 fakeOptgroup">{{ $role }}</div>
        @foreach ($placeholder as $key => $data)
            <div class="pl-3 clickable highlight-hover w-100" data-value="{{ $data[0] }}">
                {{ $key }} ({{ $data[1] }})
            </div>
        @endforeach
    @endif
@endforeach
