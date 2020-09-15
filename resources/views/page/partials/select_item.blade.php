<select class="form-control custom-select itemSelectList" id="{{ $selectId }}" name="{{ $selectId }}" size="6">
    <option></option>
    @foreach ($items as $id => $item)
        <option value="{{ $id }}">{{ $item }}</option>
    @endforeach
</select>
