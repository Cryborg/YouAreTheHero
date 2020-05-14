<div class="row">
    <div class="col">
        <nav class="nav nav-tabs mb-3">
            <a class="nav-item nav-link active" href="#tr-pre-1" data-toggle="tab">
                {{ trans('page.required_item') }}
            </a>
            @if ($story->story_options && $story->story_options->has_stats)
                <a class="nav-item nav-link" href="#tr-pre-2" data-toggle="tab">
                    {{ trans('page.required_characteristic') }}
                </a>
            @endif
            <a class="nav-item nav-link" href="#tr-pre-3" data-toggle="tab">
                {{ trans('page.required_money') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr-pre-1">
                <div class="row">
                    <div class="col">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            {!! Form::label('prerequisite_item_id', trans('page.required_item'), ['class' => 'sr-only']) !!}
                            @lang('page.required_item')
                        </div>
                        <div class="panel-body">
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
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {!! Form::label('prerequisite_quantity', trans('item.quantity')) !!}
                        </div>
                        <div class="panel-body">
                            {!! Form::number('prerequisite_quantity', old('prerequisite_quantity') ?? 1, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    </div>

                    <div class="col">
                        @include('page.partials.modal_partials_new_item', ['context' => 'prerequisites', 'story' => $page->story])
                    </div>
                </div>
            </div>

            @if ($story->story_options && $story->story_options->has_stats)
                <div class="tab-pane" id="tr-pre-2">
                    <div class="form-group mb-4">
                        {!! Form::label('sheet', trans('page.required_characteristic'), ['class' => 'sr-only']) !!}
                        <p class="help-block">{!! trans('page.required_characteristic_help') !!}</p>
                        <select class="form-control custom-select" size="6" id="sheet" name="sheet">
                            <option value=""></option>
                            @foreach(array_keys($page->story->sheet_config ?? []) as $charac)
                                @foreach($page->prerequisites() ?? [] as $prerequisite)
                                    @if ($prerequisite->prerequisiteable instanceof \App\Models\CharacterField)
                                        <option value="{{ $charac }}"
                                            @if ($prerequisite->prerequisiteable->name == $charac) selected @endif
                                        >{{ $charac }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('level', trans('page.level'), ['class' => 'control-label']) !!}
                        <p class="help-block">{!! trans('page.level_help') !!}</p>
                        {!! Form::number('level', old('level') ?? 1, ['class' => 'form-control']) !!}
                    </div>
                </div>
            @endif

            <div class="tab-pane" id="tr-pre-3">
                {!! Form::label('sheet', trans('page.required_money'), ['class' => 'sr-only']) !!}
                <p class="help-block">{!! trans('page.required_money_help') !!}</p>

                {!! Form::number('money', 1, ['class' => 'form-control', 'id' => 'prerequisite_money']) !!}
            </div>
        </div>
    </div>
</div>
