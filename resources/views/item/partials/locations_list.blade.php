@foreach ($item->triggers as $trigger)
    <div class="row w-100">
        <div class="col-8">
            {{ $trigger->actionable->name }}
        </div>
        <div class="col-4">
            <a class="btn btn-outline-danger removeItemLocation" data-actionid="{{ $trigger->id }}">
                <span class="icon-trash text-red"></span>
            </a>
        </div>
    </div>
@endforeach
