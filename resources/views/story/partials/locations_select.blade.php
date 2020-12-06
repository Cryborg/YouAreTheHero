<div class="row">
    <div class="col-8">
        <select class="form-control locationSlot">
            <option></option>
            @foreach ($story->locations as $location)
                <option value="{{ $location->id }}">{{ $location->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <a class="btn btn-primary text-center itemLocationAdd" @if ($item) data-itemid="{{ $item->id }}" @endif>
            <span class="icon-add text-white"></span>
        </a>
    </div>
</div>
