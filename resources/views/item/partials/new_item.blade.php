@if ($item)
    <input type="hidden" id="item_id_{{ $context }}" value="{{ $item->id }}">
@endif
<div class="row">
    <div class="col-sm-12 col-lg-6 border-right">
        <div class="row mb-2">
            <div class="card w-100">
                <h5 class="card-header">@lang('item.name')</h5>
                <div class="card-body">
                    {!! Form::text('item_name', $item ? $item->name : null, ['class' => 'form-control', 'placeholder' => trans('item.name'), 'id' => 'item_name_' . $context, 'autocomplete' => 'nope']) !!}
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">@lang('item.price')</h5>
                    <div class="card-body">
                        <x-help-block :help="trans('item.price_help')"></x-help-block>
                        {!! Form::number('item_price', $item ? $item->default_price : 0, ['class' => 'form-control', 'min' => 0, 'id' => 'item_price_' . $context]) !!}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h5 class="card-header">@lang('item.size')</h5>
                    <div class="card-body">
                        <x-help-block :help="trans('item.size_help')"></x-help-block>
                        {!! Form::number('item_size', $item ? $item->size : 1, ['class' => 'form-control', 'min' => 0, 'step' => .1, 'id' => 'item_size_' . $context]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="card w-100">
                <h5 class="card-header">@lang('item.options')</h5>
                <div class="card-body">
                    <x-help-block :help="trans('item.category_help')"></x-help-block>
                    <label>
                        {!! Form::text('item_category', $item ? $item->category : null,  ['class' => 'form-control', 'placeholder' => trans('item.category'), 'id' => 'item_category_' . $context, 'autocomplete' => 'nope']) !!}
                    </label>
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('item.is_unique_help')"></x-help-block>
                    <label>
                        {!! Form::checkbox('is_unique', $item ? $item->is_unique : 1, $item && $item->is_unique,  ['id' => 'is_unique_' . $context]) !!}
                        {{ trans('item.is_unique') }}
                    </label>
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('item.is_throwable_help')"></x-help-block>
                    <label>
                        {!! Form::checkbox('is_throwable', $item ? $item->is_throwable : 1, $item && $item->is_throwable ?? 1,  ['id' => 'is_throwable_' . $context]) !!}
                        {{ trans('item.is_throwable') }}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-lg-6">
        <div class="card w-100">
            @if ($story->options && $story->options->has_stats)
                <h5 class="card-header">@lang('item.effects')</h5>
                <div class="card-body">
                    <x-help-block :help="trans('item.effects_help_text')"></x-help-block>

                    <table class="w-100">
                        <thead>
                            <th>{{ trans('field.attribute') }}</th>
                            <th>{{ trans('field.operator') }}</th>
                            <th>{{ trans('field.gain_or_loss') }}</th>
                            <th>{{ trans('common.add') }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control field_id">
                                        <option></option>
                                        @foreach($story->fields->where('hidden', false) as $field)
                                            <option value="{{ $field->id }}">{{ $field->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control field_operator">
                                        <option value="+" title="@lang('common.plus')">+</option>
                                        <option value="-" title="@lang('common.minus')">-</option>
                                        <option value="/" title="@lang('common.divide')">&div;</option>
                                        <option value="*" title="@lang('common.multiply')">*</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control field_quantity" type="number" value="1">
                                </td>
                                <td>
                                    <a class="btn btn-primary text-center">
                                        <span class="icon-add text-white itemFieldAdd" @if ($item) data-itemid="{{ $item->id }}" @endif></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    <div class="card-header">
                        @lang('item.item_fields')
                    </div>
                    <div class="card-body row item-fields">
                        @if ($item)
                            @foreach ($item->fields as $field)
                                @include('item.partials.item_field', ['item' => $item, 'field' => $field])
                            @endforeach
                        @endif
                    </div>
            @endif
        </div>
    </div>
</div>
@if ((isset($displayCreateButton) && $displayCreateButton === true) || !isset($displayCreateButton))
    <div class="row">
        <div class="col">
            <div class="form-group mb-4">
                <button class="btn btn-primary btnCreateItem" data-context="{{ $context }}" data-original-text="{{ trans('item.create_btn') }}">
                    {{ trans('item.create_btn') }}
                </button>
            </div>
        </div>
    </div>
@endif
