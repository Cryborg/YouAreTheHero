<div class="row">
    <div class="col-6">
        <div class="form-group mb-4">
            {!! Form::label('items', '1. ' . trans('page.concerned_item'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('page.concerned_item_help') }}</p>
            {!! Form::select('items', $page->story->items->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group mb-4">
            {!! Form::label('action', '2. ' . trans('actions.action'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('actions.action_help') }}</p>
            {!! Form::select('action', $actions, null , ['class' => 'form-control']) !!}
        </div>

        <div class="form-group mb-4">
            {!! Form::label('quantity', '3. ' . trans('actions.quantity'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('actions.quantity_help') }}</p>
            {!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-6">

    </div>
</div>
