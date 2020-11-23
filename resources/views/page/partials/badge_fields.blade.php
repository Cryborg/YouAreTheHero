@foreach ($item->fields as $field)
    <span class="badge @if (in_array($field->pivot->operator, ['+', '*'])) badge-primary @else badge-danger @endif p-1"
        title="{{ $field->name }} {{ $field->pivot->operator }} {{ $field->pivot->quantity }}">
        {{ $field->name }}
        <span class="badge badge-light ml-2">
            {{ $field->pivot->operator }} {{ $field->pivot->quantity }}
        </span>
    </span>
@endforeach
