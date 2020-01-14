<fieldset class="mt-4">
    <legend>{{ trans('item.new_item_title') }}</legend>
    <div class="row mb-2">
        <div class="col-3">
            {!! Form::label('item_name', trans('item.name'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-9">
            {!! Form::text('item_name', null, ['class' => 'form-control', 'placeholder' => trans('item.name'), 'id' => 'item_name_' . $context]) !!}
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <p class="help-block">{!! trans('item.price_help') !!}</p>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3">
            {!! Form::label('item_price', trans('item.price'), ['class' => 'control-label text-left']) !!}
        </div>
        <div class="col-9">
            {!! Form::number('item_price', 0, ['class' => 'form-control', 'min' => 0, 'id' => 'item_price_' . $context]) !!}
        </div>
    </div>
    <label>
        {!! Form::checkbox('single_use', 1, 0,  ['id' => 'single_use_' . $context]) !!}
        {{ trans('item.single_use') }}
    </label>
    <div class="form-group mb-4">
        <button class="btn btn-primary" id="create_item_{{ $context }}" data-original-text="{{ trans('item.create_btn') }}">
            {{ trans('item.create_btn') }}
        </button>
    </div>
</fieldset>
