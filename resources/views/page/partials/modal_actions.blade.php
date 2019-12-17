{!! Form::open(['url' => route('actions.store', $page->id), 'method' => 'post', 'id' => 'action_create']) !!}
    <div class="row">
        <div class="col-6">
            <div class="form-group mb-4">
                {!! Form::label('item_id', '1. ' . trans('page.concerned_item'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('page.concerned_item_help') }}</p>
                {!! Form::select('item_id', ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(), null, ['class' => 'form-control custom-select', 'size' => 6]) !!}
                <div class="alert alert-error hidden"></div>
            </div>

            <div class="form-group mb-4">
                {!! Form::label('verb', '2. ' . trans('actions.action'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('actions.action_help') }}</p>
                {!! Form::select('verb', $actions, null , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group mb-4">
                {!! Form::label('quantity', '3. ' . trans('actions.quantity'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('actions.quantity_help') }}</p>
                {!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group mb-4">
                {!! Form::label('price', '4. ' . trans('actions.price'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('actions.price_help') }}</p>
                {!! Form::number('price', 1, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-6" id="item_description"></div>
    </div>
{!! Form::close() !!}
