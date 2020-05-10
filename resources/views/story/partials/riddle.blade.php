<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('page.riddle_header')</div>
            <div class="panel-body">
                <div id="riddle_block">
                    @if ($page->riddle->isSolved())
                        @lang('page.riddle_already_solved')
                    @else
                        <div class="input-group mb-3">
                            <input id="riddle_answer" type="text" placeholder="{{ $data->answer }}" class="form-control">
                            <div class="input-group-prepend">
                                <button id="riddle_validate" class="btn btn-outline-secondary" type="button">@lang('common.btn_validate')</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
