<div class="row">
    <div class="col-md-12 col-xl-6">
        <div class="card">
            <div class="card-header">@lang('location.modal_title')</div>
            <div class="card-body">
                <x-help-block :help="trans('location.location_help')"></x-help-block>

                <div class="form-inline">
                    <input type="text" class="form-control mr-2" id="new_location">

                    <a class="btn btn-primary addLocation">
                        <span class="icon-add text-white"></span> @lang('common.add')
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="locations-block"></div>
            </div>
        </div>
    </div>
</div>
