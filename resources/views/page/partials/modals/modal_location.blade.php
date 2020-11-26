<div class="card">
    <h5 class="card-header">
        @lang('location.name')
    </h5>
    <div class="card-body">
        <div class="card-text">
            <x-help-block :help="trans('location.name_help')"></x-help-block>
            <input type="text" id="location_name" class="w-100" data-pageid="{{ $page->id }}" required
                @if ($page->location()->count() > 0) value="{{ $page->location->name }}" @endif>
        </div>
    </div>
</div>
