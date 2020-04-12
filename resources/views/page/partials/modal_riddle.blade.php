<fieldset class="w-75">
    <legend>@lang('page.riddle_header')</legend>
    <div class="row mb-2">
        <div class="col">
            {!! Form::label('riddle_answer', trans('page.riddle_answer_label', ['class' => 'control-label'])) !!}
            <p class="help-block">{!! trans('page.riddle_answer_help') !!}</p>
            {!! Form::text('riddle_answer_text', $page->riddle ? $page->riddle->answer : '',  ['id' => 'riddle_answer_text']) !!}

            {!! Form::label('riddle_answer', trans('page.riddle_answer_checkbox', ['class' => 'control-label'])) !!}
            {!! Form::checkbox('answer_is_integer', 1, $page->riddle->type === 'integer',  ['id' => 'answer_is_integer']) !!}
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            {!! Form::label('riddle_item', trans('page.riddle_item_id_label', ['class' => 'control-label'])) !!}
            <p class="help-block">{!! trans('page.riddle_item_help') !!}</p>
            {!! Form::select(
                'riddle_item',
                ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(),
                $page->riddle->item_id ?? null,
                ['class' => 'form-control custom-select', 'size' => 6])
            !!}
        </div>
    </div>


{{--    <div class="row">--}}
{{--        <div class="col">--}}
{{--            <p class="help-block">{!! trans('page.riddle_page_help') !!}</p>--}}

{{--        </div>--}}
{{--    </div>--}}

</fieldset>
