<span class="badge @if (in_array($effect->operator, ['+', '*'])) badge-primary @else badge-danger @endif p-1"
    title="{{ $effect->field->name }} {{ $effect->operator }} {{ $effect->quantity }}">
    {{ $effect->field->short_name }}
    <span class="badge badge-light ml-2">
        {{ $effect->operator }} {{ $effect->quantity }}
    </span>
</span>
