@foreach ($story->fields as $field)
    @if ($field->hidden)
        <div class="p-2 w-100 highlight-light-hover">
            <div class="p-2">{{ $field->name }}</div>
            <div>
                <span class="clickable highlight-hover p-2" data-value="{{ $field->name }}.name">@lang('variables.name')</span>
                <span class="clickable highlight-hover p-2" data-value="{{ $field->name }}.value">@lang('variables.value')</span>
            </div>
        </div>
    @endif
@endforeach
