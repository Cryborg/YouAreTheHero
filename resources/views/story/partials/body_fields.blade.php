@foreach($story->fields ?? [] as $stat)
    <tr class="edit_field" data-fieldid="{{ $stat->id }}">
        <td>
            <input value="{{ $stat->name }}" class="form-control fieldName"
                type="text" maxlength="15" autocomplete="nope">
        </td>
        <td>
            <input value="{{ $stat->min_value }}" class="form-control fieldMinValue" type="number">
        </td>
        <td>
            <input value="{{ $stat->max_value }}" class="form-control fieldMaxValue" type="number">
        </td>
        <td>
            <input value="{{ $stat->start_value }}" class="form-control fieldStartValue" type="number">
        </td>
        <td class="text-center">
            <input type="checkbox" @if ($stat->hidden) checked @endif class="fieldHidden">
        </td>
        <td class="text-center font-bigger text-nowrap">
            <span class="icon-save mr-2 clickable editCharacterField"></span>
            <span class="icon-trash text-danger clickable deleteCharacterField"></span>
        </td>
    </tr>
@endforeach
