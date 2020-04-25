<div class="row">
    <div class="col">
        <nav class="nav nav-pills mb-3">
            <a class="nav-item nav-link active" href="#tr1" data-toggle="tab">
                {{ trans('page.riddle_header') }}
            </a> <a class="nav-item nav-link" href="#tr2" data-toggle="tab">
                {{ trans('item.new_item_title') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr1">
                <div class="row">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                {!! Form::label('riddle_answer', trans('page.riddle_answer_label', ['class' => 'control-label'])) !!}
                                <p class="help-block">{!! trans('page.riddle_answer_help') !!}</p>
                                {!! Form::text('riddle_answer_text', $page->riddle ? $page->riddle->answer : '',  ['id' => 'riddle_answer_text']) !!}

                                {!! Form::label('riddle_answer', trans('page.riddle_answer_checkbox', ['class' => 'control-label'])) !!}
                                {!! Form::checkbox('answer_is_integer', 1, $page->riddle ? $page->riddle->type === 'integer' : null,  ['id' => 'answer_is_integer']) !!}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                {!! Form::label('riddle_item', trans('page.riddle_item_label', ['class' => 'control-label'])) !!}
                                <p class="help-block">{!! trans('page.riddle_item_help') !!}</p>
                                {!! Form::select(
                                    'riddle_item',
                                    ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(),
                                    $page->riddle && $page->riddle->item_id ?? null,
                                    ['class' => 'form-control custom-select', 'size' => 6])
                                !!}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                {!! Form::label('riddle_page', trans('page.riddle_page_label', ['class' => 'control-label'])) !!}
                                <p class="help-block">{!! trans('page.riddle_page_help') !!}</p>
                                <select class="form-control custom-select" id="riddle_page" size="6">
                                    <option value="0">{{ trans('page.existing_page') }}</option>
                                    @foreach ($story->pages as $existingPage)
                                        @if ($page->uuid !== $existingPage->uuid)
                                            <option value="{{ $existingPage->uuid }}"
                                                @if ($page->riddle)
                                                    @if ($existingPage->uuid === $page->riddle->target_page)
                                                        selected
                                                    @endif
                                                @endif
                                                >{{ $existingPage->title }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                {!! Form::label('riddle_page_text_label', trans('page.riddle_page_text_label', ['class' => 'control-label'])) !!}
                                {!! Form::text('riddle_target_text', $page->riddle ? $page->riddle->target_text : '',  ['id' => 'riddle_target_text']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tr2">
                @include('page.partials.modal_partials_new_item', ['context' => 'riddle', 'story' => $page->story])
            </div>
        </div>
    </div>
</div>
