<div class="row">
    <div class="col">
        <nav class="nav nav-tabs mb-3">
            <a class="nav-item nav-link active" href="#tr-pre-1" data-toggle="tab">
                {{ trans('page.required_item') }}
            </a>
            @if ($story->options && $story->options->has_stats)
                <a class="nav-item nav-link" href="#tr-pre-2" data-toggle="tab" id="tr-pre-2-link">
                    {{ trans('page.required_characteristic') }}
                </a>
            @endif
            <a class="nav-item nav-link" href="#tr-pre-3" data-toggle="tab">
                {{ trans('item.new_item_title') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr-pre-1">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-header">
                                {!! Form::label('item_id', trans('page.required_item'), ['class' => 'sr-only']) !!}
                                @lang('page.required_item')
                            </h5>
                            <div class="card-body">
                                <div class="card-text">
                                    <p class="help-block">{!! trans('page.required_item_help') !!}</p>

                                    <div class="items_select_list"></div>
                                </div>
                            </div>
                            <h5 class="card-header">
                                {!! Form::label('quantity', trans('item.quantity')) !!}
                            </h5>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-8">
                                        <select id="item_operator" name="item_operator" class="form-control">
                                            <option value="gte">>= Egal ou supérieur</option>
                                            <option value="lte"><= Egal ou inférieur</option>
                                            <option value="eq">= Strictement égal</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        {!! Form::number('quantity', old('quantity') ?? 1, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div id="price_field">
                                <div class="card-header">
                                    {!! Form::label('price', trans('item_page.price'), ['class' => 'control-label mt-2']) !!}
                                </div>
                                <div class="card-body">
                                    <p class="help-block">{{ trans('item_page.price_help') }}</p>
                                    {!! Form::number('price', 1, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                @lang('item.details')
                                <button type="submit" class="btn btn-primary btnCreateItem float-right" disabled data-context="edit">@lang('common.save')</button>
                            </div>
                            <div class="card-body item-details"></div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($story->options && $story->options->has_stats)
                <div class="tab-pane" id="tr-pre-2">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group mb-4">
                                {!! Form::label('sheet', trans('page.required_characteristic'), ['class' => 'sr-only']) !!}
                                <p class="help-block">{!! trans('page.required_characteristic_help') !!}</p>
                                <select class="form-control custom-select" size="6" id="sheet" name="sheet">
                                    <option value=""></option>
                                    <optgroup label="Stats"></optgroup>
                                    @foreach($page->story->fields->where('hidden', false) as $field)
                                        <option value="{{ $field->id }}"
                                        >{{ $field->name }}</option>
                                    @endforeach
                                    <optgroup label="Variables"></optgroup>
                                    @foreach($page->story->fields->where('hidden', true) as $field)
                                        <option value="{{ $field->id }}"
                                        >{{ $field->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    {!! Form::label('level', trans('page.level'), ['class' => 'control-label']) !!}
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-12">
                                            <p class="help-block">{!! trans('page.level_help') !!}</p>
                                        </div>
                                        <div class="col-8">
                                            <select id="field_operator" name="field_operator" class="form-control">
                                                <option value="gte">>= Egal ou supérieur</option>
                                                <option value="lte"><= Egal ou inférieur</option>
                                                <option value="eq">= Strictement égal</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            {!! Form::number('level', old('level') ?? 1, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="tab-pane" id="tr-pre-3">
                <div class="container">
                    @include('item.partials.new_item', ['context' => $context, 'story' => $page->story])
                </div>
            </div>
        </div>
    </div>
</div>
