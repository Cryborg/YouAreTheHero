<fieldset class="mt-4 container">
    <legend>{{ trans('item.new_item_title') }}</legend>
    <div class="row">
        <div class="col-sm-12 col-lg-6 border-right">
            <div class="row mb-2">
                <div class="col-sm-12 col-lg-2">
                    {!! Form::label('item_name', trans('item.name'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-sm-12 col-lg-4">
                    {!! Form::text('item_name', null, ['class' => 'form-control', 'placeholder' => trans('item.name'), 'id' => 'item_name_' . $context, 'autocomplete' => 'nope']) !!}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <p class="help-block">{!! trans('item.price_help') !!}</p>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4 col-lg-2">
                    {!! Form::label('item_price', trans('item.price'), ['class' => 'control-label text-left']) !!}
                </div>
                <div class="col-sm-8 col-lg-4">
                    {!! Form::number('item_price', 0, ['class' => 'form-control', 'min' => 0, 'id' => 'item_price_' . $context]) !!}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <p class="help-block">{!! trans('item.single_use_help') !!}</p>
                </div>
            </div>
            <label>
                {!! Form::checkbox('single_use', 1, 0,  ['id' => 'single_use_' . $context]) !!}
                {{ trans('item.single_use') }}
            </label>
        </div>

        <div class="col-sm-12 col-lg-6">
            <div class="row">
                <div class="col">
                    <p class="help-block">{{ trans('item.effects_help_text') }}</p>
                    {!! Form::label('effects_' . $context, trans('item.effects'), ['class' => 'control-label']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col pl-sm-2 pl-lg-5">
                    <table class="w-100">
                        <thead>
                            <th>{{ trans('field.attribute') }}</th>
                            <th>{{ trans('field.gain_or_loss') }}</th>
                        </thead>
                        <tbody>
                            @foreach($story->fields as $stat)
                                <tr>
                                    <td>{{ $stat->full_name }}</td>
                                    <td><input name="stat_values[]" data-id="{{ $stat->id }}" class="mb-1" type="number"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
</fieldset>
