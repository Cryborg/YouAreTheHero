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
                <div class="row">
                    <div class="col">
                        {!! Form::label('prerequisite_item_id', trans('page.required_item'), ['class' => 'sr-only']) !!}
                        <p class="help-block">{!! trans('page.required_item_help') !!}</p>
                        <select multiple="" class="form-control custom-select" size="6" id="prerequisite_item_id" name="prerequisite_item_id">
                            <option value=""></option>
                            @foreach ($page->story->items->sortBy('name')->pluck('name', 'id')->toArray() ?? [] as $itemId => $itemName)
                                <option value="{{ $itemId }}"
                                    @foreach($page->prerequisites() ?? [] as $prerequisite)
                                    @foreach ($prerequisite->items ?? [] as $item)
                                    @if ($item->id == $itemId) selected @endif
                                    @endforeach
                                    @endforeach
                                >{{ $itemName }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            {!! Form::label('prerequisite_quantity', trans('item.quantity')) !!}
                            {!! Form::number('prerequisite_quantity', old('prerequisite_quantity') ?? 1, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        @include('page.partials.modal_partials_new_item', ['context' => 'prerequisites'])
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="tr2">
                <div class="form-group mb-4">
                    {!! Form::label('sheet', trans('page.required_characteristic'), ['class' => 'sr-only']) !!}
                    <p class="help-block">{!! trans('page.required_characteristic_help') !!}</p>
                    <select class="form-control custom-select" size="6" id="sheet" name="sheet">
                        <option value=""></option>
                        @php
                            $characValue = 1;
                        @endphp
                        @foreach(array_keys($page->story->sheet_config ?? []) as $charac)
                            @foreach($page->prerequisites['sheet'] ?? [] as $prerequisite => $value)
                                <option value="{{ $charac }}"
                                    @if ($prerequisite == $charac)
                                        selected
                                        @php
                                            $characValue = $value;
                                        @endphp
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

                {!! Form::number('money', 1, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>
