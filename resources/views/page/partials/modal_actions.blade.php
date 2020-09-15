<div class="row">
    <div class="col">
        <nav class="nav nav-tabs mb-3">
            <a class="nav-item nav-link active" href="#tr-actions-1" data-toggle="tab">
                @lang('actions.item')
            </a>

            @if ($story->story_options && $story->story_options->has_stats)
                <a class="nav-item nav-link" href="#tr-actions-2" data-toggle="tab">
                    @lang('actions.field')
                </a>
            @endif

            <a class="nav-item nav-link" href="#tr-actions-3" data-toggle="tab">
                {{ trans('item.new_item_title') }}
            </a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="tr-actions-1">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                @lang('actions.item')
                            </div>
                            <div class="card-body">
                                <p class="help-block">@lang('actions.item_help')</p>

                                <select class="form-control custom-select itemSelectList" size="6" id="{{ $context }}_item_id" name="{{ $context }}_item_id">
                                    @foreach ($page->story->items->sortBy('name')->pluck('name', 'id')->toArray() ?? [] as $itemId => $itemName)
                                        <option value="{{ $itemId }}">{{ $itemName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-header">
                                @lang('actions.quantity')
                            </div>
                            <div class="card-body">
                                <input type="number" id="actions_item_qty" value="1">
                            </div>
                            <div class="card-footer">
                                <div class="btn btn-primary addActionsItem">
                                    <span class="icon-add text-white mr-2"></span> @lang('common.add')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                @lang('item.details')
                            </div>
                            <div class="card-body item-details">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($story->story_options && $story->story_options->has_stats)
                <div class="tab-pane" id="tr-actions-2">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    @lang('actions.field')
                                </div>
                                <div class="card-body">
                                    <p class="help-block">@lang('actions.field_help')</p>

                                    <select class="form-control custom-select" size="10" id="actions_field_id" name="{{ $context }}_item_id">
                                        @foreach ($page->story->fields->sortBy('name')->pluck('name', 'id')->toArray() ?? [] as $itemId => $itemName)
                                            <option value="{{ $itemId }}">{{ $itemName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-header">
                                    @lang('actions.quantity')
                                </div>
                                <div class="card-body">
                                    <input type="number" id="actions_field_qty" value="1">
                                </div>
                                <div class="card-footer">
                                    <div class="btn btn-primary addActionsField">
                                        <span class="icon-add text-white mr-2"></span> @lang('common.add')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    @lang('actions.existing_bonuses')
                                </div>
                                <div class="card-body">
                                    <p class="help-block">@lang('actions.bonuses_help')</p>
                                    @include('page.partials.actions_list', ['page' => $page])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="tab-pane" id="tr-actions-3">
                <div class="container">
                    @include('item.partials.new_item', ['context' => $context, 'story' => $page->story])
                </div>
            </div>
        </div>
    </div>
</div>

