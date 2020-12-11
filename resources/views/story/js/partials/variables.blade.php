@foreach ($story->fields as $field)
    @if ($field->hidden)
        <div class="p-2 w-100 highlight-light-hover">
            <span>{{ $field->name }}</span>
            <span class="clickable highlight-hover p-1 float-right" data-value="{{ $field->name }}.value">@lang('variables.value')</span>
            <span class="clickable highlight-hover p-1 float-right" data-value="{{ $field->name }}.name">@lang('variables.name')</span>
        </div>
    @endif
@endforeach
