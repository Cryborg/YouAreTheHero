<div class="card">
    <div class="card-header">
        @lang('location.existing_locations')
    </div>
    <div class="card-body">
        <x-help-block :help="trans('location.existing_locations_help')"></x-help-block>

        <select class="form-control" id="existingLocationId">
            <option value="0"></option>
            @foreach ($page->story->locations->where('page_id', null) as $location)
                <option value="{{ $location->id }}"
{{--                @if ($location->id === $page->location->id) selected @endif--}}
                >{{ $location->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card">
    <div class="card-header">
        @lang('location.name')
    </div>
    <div class="card-body">
        <div class="card-text">
            <x-help-block :help="trans('location.name_help')"></x-help-block>
            <input type="text" id="location_name" class="form-control w-100"
                data-pageid="{{ $page->id }}" required>
        </div>
    </div>
</div>
