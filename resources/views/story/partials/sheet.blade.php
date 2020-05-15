@foreach($fields as $field)
    <div class="input-group mb-1">
        <div class="input-group-prepend w-50">
            <span class="input-group-text w-100">
                {{ $field->full_name }}
            </span>
        </div>
        <div class="form-control">
            {{ $field->pivot->value }}
        </div>
    </div>
@endforeach
