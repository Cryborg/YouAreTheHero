@foreach ($story->equipment as $equipment)
    <div class="row mb-2">
        <div class="col-7">
            <input class="form-control" type="text" value="{{ $equipment->slot }}" id="equipment_{{ $equipment->id }}">
        </div>
        <div class="col">
            <a class="btn btn-outline-dark">
                <span class="icon-save text-center font-biggest updateEquipment" data-equipmentid="{{ $equipment->id }}"></span>
            </a>
            <a class="btn btn-outline-danger">
                <span class="icon-trash text-red text-center font-biggest deleteEquipment" data-equipmentid="{{ $equipment->id }}"></span>
            </a>
        </div>
    </div>
@endforeach
