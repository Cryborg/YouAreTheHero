<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @if ($page->riddle && $page->riddle->title)
                        {{ $page->riddle->title }}
                    @else
                        @lang('page.riddle_header')
                    @endif
                </h5>
                <p class="card-text riddle-block"></p>
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
