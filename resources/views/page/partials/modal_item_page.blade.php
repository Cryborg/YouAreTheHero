<div class="row">
    <div class="col">
        <nav class="nav nav-tabs mb-3">
            <a class="nav-item nav-link active" href="#tr1" data-toggle="tab">
                {{ trans('page.existing_item') }}
            </a> <a class="nav-item nav-link" href="#tr2" data-toggle="tab">
                {{ trans('item.new_item_title') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr1">
                {!! Form::open(['url' => route('page.item.store', $page->id), 'method' => 'post', 'id' => 'action_create']) !!}
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {!! Form::label('item_id', trans('page.concerned_item'), ['class' => 'control-label mt-2']) !!}
                            </div>
                            <div class="card-body">
                                <p class="help-block">{{ trans('page.concerned_item_help') }}</p>
                                <div>
                                    <select class="selectpicker itemSelectList w-100" id="item_id" name="item_id"
                                        data-header="@lang('item.select_item')" size="6"
                                        data-live-search="true"
                                        data-live-search-normalize="true"
                                        data-none-selected-text="@lang('common.none_selected')">
                                        @foreach ($page->story->items->sortBy('name') as $item)
                                            <option value="{{ $item->id }}" data-content='@include('page.js.partials.select_subtext', ['item' => $item])'></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                {!! Form::label('verb', trans('item_page.action'), ['class' => 'control-label mt-2']) !!}
                            </div>
                            <div class="card-body">
                                <p class="help-block">{{ trans('item_page.action_help') }}</p>
                                <select class="selectpicker" id="verb" name="verb"
                                    data-header="@lang('item.select_action')">
                                    @foreach ($actions as $key => $action)
                                        <option value="{{ $key }}">{{ $action }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                {!! Form::label('quantity', trans('item_page.quantity'), ['class' => 'control-label mt-2']) !!}
                            </div>
                            <div class="card-body">
                                <p class="help-block">{{ trans('item_page.quantity_help') }}</p>
                                {!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                {!! Form::label('price', trans('item_page.price'), ['class' => 'control-label mt-2']) !!}
                            </div>
                            <div class="card-body">
                                <p class="help-block">{{ trans('item_page.price_help') }}</p>
                                {!! Form::number('price', 1, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @lang('page.items_on_page')
                            </div>
                            <div class="card-body itemsOnPage">
                                @include('page.partials.item_page_list', ['items' => $page->items])
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="tr2">
                <div class="container">
                    @include('item.partials.new_item', ['context' => $context, 'story' => $page->story])
                </div>
            </div>
        </div>
    </div>
</div>

