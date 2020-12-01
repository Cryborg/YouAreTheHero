<select class="form-control equipmentSlot">
    <option></option>
    @foreach ($story->equipment as $equipment)
        <option value="{{ $equipment->id }}">{{ $equipment->slot }}</option>
    @endforeach
</select>
