<div class="row">
    <div class="col">
        <nav class="nav nav-pills mb-3" id="choicesList">
            <a class="nav-item nav-link active" href="#tr1" data-toggle="tab">
                {{ trans('page.required_item') }}
            </a> <a class="nav-item nav-link" href="#tr2" data-toggle="tab">
                {{ trans('page.required_characteristic') }}
            </a> <a class="nav-item nav-link" href="#tr3" data-toggle="tab">
                {{ trans('page.required_money') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr1">
                {!! Form::label('prerequisite_item_id', trans('page.required_item'), ['class' => 'sr-only']) !!}
                <p class="help-block">{!! trans('page.required_item_help') !!}</p>
                <select multiple="" class="form-control custom-select" size="6" id="prerequisite_item_id" name="prerequisite_item_id">
                    <option value=""></option>
                    @foreach ($page->story->items->sortBy('name')->pluck('name', 'id')->toArray() as $itemId => $itemName)
                        @foreach($page->prerequisites['items'] as $prerequisite)
                            <option value="{{ $itemId }}" @if ($prerequisite == $itemId)selected
                                @endif
                                @endforeach
                            >{{ $itemName }}</option>
                        @endforeach
                </select>
                <fieldset class="mt-4">
                    <legend>{{ trans('item.new_item_title') }}</legend>
                    <div class="row mb-2">
                        <div class="col-3">
                            {!! Form::label('item_name', trans('item.name'), ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-9">
                            {!! Form::text('item_name', null, ['class' => 'form-control', 'placeholder' => trans('item.name')]) !!}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            {!! Form::label('item_price', trans('item.price'), ['class' => 'control-label text-left']) !!}
                        </div>
                        <div class="col-9">
                            {!! Form::number('item_price', 0, ['class' => 'form-control', 'min' => 0]) !!}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p class="help-block">{!! trans('item.price_help') !!}</p>
                        </div>
                    </div>
                    <label>
                        {!! Form::checkbox('single_use', 1, 0,  ['id' => 'single_use']) !!}
                        {{ trans('item.single_use') }}
                    </label>
                    <div class="form-group mb-4">
                        <button class="btn btn-primary" id="create_item" data-original-text="{{ trans('item.create_btn') }}">
                            {{ trans('item.create_btn') }}
                        </button>
                    </div>
                </fieldset>
            </div>
            <div class="tab-pane" id="tr2">
                <div class="form-group mb-4">
                    {!! Form::label('sheet', trans('page.required_characteristic'), ['class' => 'sr-only']) !!}
                    <p class="help-block">{!! trans('page.required_characteristic_help') !!}</p>
                    <select class="form-control custom-select" size="6" id="sheet" name="sheet">
                        <option value=""></option>
                        {{ $characValue = 1 }}
                        @foreach(array_keys($page->story->sheet_config ?? []) as $charac)
                            @foreach($page->prerequisites['sheet'] as $prerequisite => $value)
                                <option value="{{ $charac }}"
                                @if ($prerequisite == $charac)
                                    selected
                                    {{ $characValue = $value }}
                                @endif
                                >{{ $charac }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    {!! Form::label('level', trans('page.level'), ['class' => 'control-label']) !!}
                    <p class="help-block">{!! trans('page.level_help') !!}</p>
                    {!! Form::number('level', $characValue, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="tab-pane" id="tr3">
                {!! Form::label('sheet', trans('page.required_money'), ['class' => 'sr-only']) !!}
                <p class="help-block">{!! trans('page.required_money_help') !!}</p>
                {{-- TODO --}}
                Not done yet ;)
            </div>
        </div>
    </div>
</div>
