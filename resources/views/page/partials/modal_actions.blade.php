{!! Form::open(['url' => route('actions.store', $page->id), 'method' => 'post', 'id' => 'action_create']) !!}
    <div class="row">
        <div class="col-6">
            <div class="form-group mb-4">
                {!! Form::label('item_id', '1. ' . trans('page.concerned_item'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('page.concerned_item_help') }}</p>
                {!! Form::select('item_id', ['' => ''] + $page->story->items->sortBy('name')->pluck('name', 'id')->toArray(), null, ['class' => 'form-control custom-select', 'size' => 6]) !!}
                <div class="alert alert-error hidden"></div>
            </div>

            <p class="help-block">{{ trans('actions.action_help') }}</p>
            <div class="row mb-2">
                <div class="col-3">
                    {!! Form::label('verb', '2. ' . trans('actions.action'), ['class' => 'control-label mt-2']) !!}
                </div>
                <div class="col-9">
                    {!! Form::select('verb', $actions, null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <p class="help-block">{{ trans('actions.quantity_help') }}</p>
            <div class="row mb-2">
                <div class="col-3">
                    {!! Form::label('quantity', '3. ' . trans('actions.quantity'), ['class' => 'control-label mt-2']) !!}
                </div>
                <div class="col-9">
                    {!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
                </div>
            </div>

            <p class="help-block">{{ trans('actions.price_help') }}</p>
            <div class="row mb-2">
                <div class="col-3">
                    {!! Form::label('price', '4. ' . trans('actions.price'), ['class' => 'control-label mt-2']) !!}
                </div>
                <div class="col-9">
                    {!! Form::number('price', 1, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="row h-25" id="item_description">

            </div>

            <hr>
            
            <div class="row">
                @include('page.partials.modal_partials_new_item', ['context' => 'action'])
            </div>
        </div>
    </div>
{!! Form::close() !!}
