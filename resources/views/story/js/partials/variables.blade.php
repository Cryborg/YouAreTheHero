<div class="p-2 w-100 highlight-light-hover">
    <span class="clickable" data-value="currency_name">
        @lang('variables.currency_name', ['currency' => $story->currency->name])
    </span>
</div>
<hr class="m-1">
@foreach ($story->fields->where('hidden', true) as $field)
    <div class="p-2 w-100 highlight-light-hover">
        <span>{{ $field->name }}</span>
        <span class="clickable highlight-hover p-1 float-right" data-value="{{ $field->name }}.value">@lang('variables.value')</span>
        <span class="clickable highlight-hover p-1 float-right" data-value="{{ $field->name }}.name">@lang('variables.name')</span>
    </div>
@endforeach
