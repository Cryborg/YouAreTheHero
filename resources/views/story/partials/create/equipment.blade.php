<div class="row">
    <div class="col-md-12 col-xl-6">
        <div class="card">
            <div class="card-header">@lang('equipment.add_slot_label')</div>
            <div class="card-body">
                <x-help-block :help="trans('equipment.add_slot_help')"></x-help-block>

                <div class="form-inline">
                    <input type="text" class="form-control mr-2" id="new_equipment">

                    <a class="btn btn-primary addEquipment">
                        <span class="icon-add text-white"></span> @lang('common.add')
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="slotsList">
                </div>
            </div>
        </div>
    </div>
</div>
