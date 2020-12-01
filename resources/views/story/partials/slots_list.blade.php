<div class="card">
    <div class="card-header">
        @lang('equipment.slots_name')
    </div>
    <div class="card-body">
        @foreach ($story->equipment as $equipment)
            <div class="row mb-2">
                <div class="col-7">
                    <input class="form-control" type="text" value="{{ $equipment->slot }}" id="equipment_{{ $equipment->id }}">
                </div>
                <div class="col">
                    <a class="btn btn-outline-dark">
                        <span class="icon-save text-center font-biggest updateSlot" data-equipmentid="{{ $equipment->id }}"></span>
                    </a>
                    <a class="btn btn-outline-danger">
                        <span class="icon-trash text-red text-center font-biggest deleteSlot" data-equipmentid="{{ $equipment->id }}"></span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
