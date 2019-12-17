<div class="row">
    <div class="col-6">
        <div class="form-group mb-4">
            {!! Form::label('items', trans('page.required_item'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('page.required_item_help') }}</p>
            {!! Form::select('items', ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(), null, ['class' => 'form-control custom-select', 'size' => 6]) !!}
        </div>

        <div class="form-group mb-4">
            {!! Form::label('sheet', trans('page.required_characteristic'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('page.required_characteristic_help') }}</p>
            {!! Form::select('sheet', ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(), null, ['class' => 'form-control custom-select', 'size' => 6]) !!}
        </div>
    </div>
    <div class="col-6" id="item_description">

    </div>
</div>
