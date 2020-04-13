<div class="row">
    <div class="col">
        <fieldset>
            <legend>@lang('page.riddle_header')</legend>
            <div id="riddle_block">
                @if ($page->riddle->isSolved())
                    @lang('page.riddle_already_solved')
                @else
                    <input id="riddle_answer" type="text" placeholder="{{ $data->answer }}">
                    <button id="riddle_validate" class="btn-primary">@lang('common.btn_validate')</button>
                @endif
            </div>
        </fieldset>
    </div>
</div>
