<div class="row">
    <div class="col-6">
        <nav class="nav nav-pills mb-3" id="choicesList">
            <a class="nav-item nav-link active" href="#tr1" data-toggle="tab">
                {{ trans('page.required_item') }}
            </a>
            <a class="nav-item nav-link" href="#tr2" data-toggle="tab">
                {{ trans('page.required_characteristic') }}
            </a>
            <a class="nav-item nav-link" href="#tr3" data-toggle="tab">
                {{ trans('page.required_money') }}
            </a>
        </nav>

        <div class="tab-content">
            <div class="tab-pane active" id="tr1">
                <div class="form-group mb-4">
                    {!! Form::label('prerequisite_item_id', trans('page.required_item'), ['class' => 'sr-only']) !!}
                    <p class="help-block">{!! trans('page.required_item_help') !!}</p>
                    {!! Form::select('prerequisite_item_id', ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(), null, ['class' => 'form-control custom-select', 'size' => 6]) !!}
                </div>
            </div>
            <div class="tab-pane" id="tr2">
                <div class="form-group mb-4">
                    {!! Form::label('sheet', trans('page.required_characteristic'), ['class' => 'sr-only']) !!}
                    <p class="help-block">{!! trans('page.required_characteristic_help') !!}</p>
                    {!! Form::select('sheet', ['' => ''] + array_keys($page->story->sheet_config), null, ['class' => 'form-control custom-select', 'size' => 6]) !!}
                </div>

                <div class="form-group mb-4">
                    {!! Form::label('level', trans('page.level'), ['class' => 'control-label']) !!}
                    <p class="help-block">{!! trans('page.level_help') !!}</p>
                    {!! Form::number('level', 1, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="tab-pane" id="tr3">
                {!! Form::label('sheet', trans('page.required_money'), ['class' => 'sr-only']) !!}
                <p class="help-block">{!! trans('page.required_money_help') !!}</p>

                {{-- TODO --}}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row minh-50">
            <div class="col" id="prerequisite_item_description">
                <fieldset>
                    <legend>{{ trans('item.item_description_title') }}</legend>
                </fieldset>
            </div>
        </div>
        <div class="row minh-50">
            <div class="col">
                <fieldset>
                    <legend>{{ trans('page.to_be_added_prerequisites') }}</legend>

                </fieldset>
            </div>
        </div>
    </div>
</div>
