@foreach($fields as $field)
    @if ($field->hidden === false || $show_hidden_fields)
        <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
            <span class="input-group-text w-100">
                @if ($field->hidden === true && $show_hidden_fields)
                    <span class="icon-hidden text-red font-bigger mr-2" title="@lang('field.hidden_to_players')"></span>
                @endif
                {{ $field->name }}
            </span>
            </div>
            <div class="form-control">
                {{ $field->pivot->value }}
            </div>
        </div>
    @endif
@endforeach
