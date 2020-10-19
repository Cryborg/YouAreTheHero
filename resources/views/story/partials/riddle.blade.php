<div class="row">
    <div class="col-12">
        <div class="card border">
            <h5 class="card-header">
                @if ($page->riddle && $page->riddle->title)
                    {{ $page->riddle->present()->title }}
                @else
                    @lang('page.riddle_header')
                @endif
            </h5>
            <div class="card-body">
                <p class="card-text riddle-block"></p>
                    @if ($page->riddle->isSolved($character))
                        @lang('page.riddle_already_solved')
                    @else
                        <div class="riddle_text">
                            @if ($page->riddle->type === 'integer')
                                <div class="form-inline row">
                                    @for ($i = 1, $iMax = strlen($page->riddle->answer); $i <= $iMax; $i++)
                                        <div class="col-1">
                                            <input class="input-spinner" type="number" value="1" min="0" max="9" step="1" />
                                        </div>
                                    @endfor
                                </div>
                            @endif
                            <div class="input-group mb-3">
                                <input id="riddle_answer" type="text" class="form-control @if ($page->riddle->type === 'integer') hidden @endif">
                                <div class="input-group-prepend">
                                    <button id="riddle_validate" class="btn btn-outline-secondary" type="button">@lang('common.btn_validate')</button>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
