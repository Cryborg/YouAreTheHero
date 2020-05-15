<div class="row">
    <div class="col">
        <nav class="nav nav-tabs mb-3">
            <a class="nav-item nav-link active" href="#tr-riddle-1" data-toggle="tab">
                {{ trans('page.riddle_header') }}
            </a> <a class="nav-item nav-link" href="#tr-riddle-2" data-toggle="tab">
                {{ trans('item.new_item_title') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr-riddle-1">
                <div class="row">
                    <div class="col">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {!! Form::label('riddle_answer', trans('page.riddle_answer_label', ['class' => 'control-label'])) !!}
                            </div>
                            <div class="panel-body">
                                <p class="help-block">{!! trans('page.riddle_answer_help') !!}</p>
                                {!! Form::text('riddle_answer_text', $page->riddle ? $page->riddle->answer : '',  ['id' => 'riddle_answer_text']) !!}
                                <br>
                                {!! Form::checkbox('answer_is_integer', 1, $page->riddle ? $page->riddle->type === 'integer' : null,  ['id' => 'answer_is_integer']) !!}
                                {!! Form::label('riddle_answer', trans('page.riddle_answer_checkbox', ['class' => 'control-label'])) !!}
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {!! Form::label('riddle_item', trans('page.riddle_item_label', ['class' => 'control-label'])) !!}
                            </div>
                            <div class="panel-body">
                                <p class="help-block">{!! trans('page.riddle_item_help') !!}</p>
                                {!! Form::select(
                                    'riddle_item',
                                    ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(),
                                    $page->riddle && $page->riddle->item_id ?? null,
                                    ['class' => 'form-control custom-select', 'size' => 6])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {!! Form::label('riddle_page', trans('page.riddle_page_label', ['class' => 'control-label'])) !!}
                            </div>
                            <div class="panel-body">
                                <p class="help-block">{!! trans('page.riddle_page_help') !!}</p>
                                <select class="form-control custom-select" id="riddle_page" size="6">
                                    <option value="">{{ trans('page.existing_page') }}</option>
                                    @foreach ($story->pages as $existingPage)
                                        @if ($page->id !== $existingPage->id)
                                            <option value="{{ $existingPage->id }}" @if ($page->riddle)@if ($existingPage->id === $page->riddle->target_page_id)selected
                                                @endif
                                                @endif
                                            >{{ $existingPage->title }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="panel-heading">
                                {!! Form::label('riddle_page_text_label', trans('page.riddle_page_text_label', ['class' => 'control-label'])) !!}
                            </div>
                            <div class="panel-body">
                                {!! Form::text('riddle_target_page_text', $page->riddle ? $page->riddle->target_page_text : '',  ['id' => 'riddle_target_page_text']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tr-riddle-2">
                <div class="container">
                    @include('item.partials.new_item', ['context' => 'prerequisites', 'story' => $page->story])
                </div>
            </div>
        </div>
    </div>
</div>
