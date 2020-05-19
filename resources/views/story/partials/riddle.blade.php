<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if ($page->riddle && $page->riddle->title)
                    {{ $page->riddle->title }}
                @else
                    @lang('page.riddle_header')
                @endif
            </div>
            <div class="panel-body">
                <div id="riddle_block">
                    @if ($page->riddle->isSolved())
                        @lang('page.riddle_already_solved')
                    @else
                        <div class="input-group mb-3">
                            <input id="riddle_answer" type="text" class="form-control">
                            <div class="input-group-prepend">
                                <button id="riddle_validate" class="btn btn-outline-secondary" type="button"
                                    data-pageid="{{ $page->id }}">@lang('common.btn_validate')</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
