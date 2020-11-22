@foreach ($story->fields as $field)
    @if ($field->hidden)
        <div class="p-2 w-100 clickable highlight-hover"
                data-value="{{ $field->name }}">
            {{ $field->name }}
        </div>
    @endif
@endforeach
