<div class="row">
    <div class="col-sm-12 col-lg-6 border-right">
        <div class="row mb-2">
            <div class="card w-100">
                <h5 class="card-header">@lang('item.name')</h5>
                <div class="card-body">
                    <div class="card-text">
                        {!! Form::text('item_name', null, ['class' => 'form-control', 'placeholder' => trans('item.name'), 'id' => 'item_name_' . $context, 'autocomplete' => 'nope']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
            </div>
        </div>
        <div class="row mb-2">
            <div class="card w-100">
                <h5 class="card-header">@lang('item.price')</h5>
                <div class="card-body">
                    <div class="card-text">
                        <p class="help-block">{!! trans('item.price_help') !!}</p>
                        {!! Form::number('item_price', 0, ['class' => 'form-control', 'min' => 0, 'id' => 'item_price_' . $context]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="card w-100">
                <h5 class="card-header">@lang('item.size')</h5>
                <div class="card-body">
                    <div class="card-text">
                        <p class="help-block">{!! trans('item.size_help') !!}</p>
                        {!! Form::number('item_size', 1, ['class' => 'form-control', 'min' => 0, 'step' => .1, 'id' => 'item_size_' . $context]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-lg-6">
        <div class="card w-100">
            <h5 class="card-header">@lang('item.options')</h5>
            <div class="card-body">
                <div class="card-text">
                    <p class="help-block">{!! trans('item.single_use_help') !!}</p>
                    <label>
                        {!! Form::checkbox('single_use', 1, 0,  ['id' => 'single_use_' . $context]) !!}
                        {{ trans('item.single_use') }}
                    </label>
                </div>
            </div>
            @if ($story->story_options && $story->story_options->has_stats)
                <h5 class="card-header">@lang('item.effects')</h5>
                <div class="card-body">
                    <div class="card-text">
                        <p class="help-block">{{ trans('item.effects_help_text') }}</p>

                        <table class="w-100">
                            <thead>
                                <th>{{ trans('field.attribute') }}</th>
                                <th>{{ trans('field.gain_or_loss') }}</th>
                            </thead>
                            <tbody>
                                @foreach($story->fields as $stat)
                                    <tr>
                                        <td>{{ $stat->name }}</td>
                                        <td><input name="stat_values[]" data-id="{{ $stat->id }}" class="mb-1" type="number"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group mb-4">
            <button class="btn btn-primary" id="create_item_{{ $context }}" data-original-text="{{ trans('item.create_btn') }}">
                {{ trans('item.create_btn') }}
            </button>
        </div>
    </div>
</div>
