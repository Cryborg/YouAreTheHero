@foreach ($story->locations as $location)
    <div class="row mb-2">
        <div class="col-7">
            <input class="form-control" type="text" value="{{ $location->name }}" id="location_{{ $location->id }}">
        </div>
        <div class="col">
            <a class="btn btn-outline-dark">
                <span class="icon-save text-center font-biggest updateLocation" data-locationid="{{ $location->id }}"></span>
            </a>
            <a class="btn btn-outline-danger">
                <span class="icon-trash text-red text-center font-biggest deleteLocation" data-locationid="{{ $location->id }}"></span>
            </a>
        </div>
    </div>
@endforeach
