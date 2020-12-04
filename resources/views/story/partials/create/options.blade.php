<div class="row">
    <div class="col-md-12 col-lg-6">
        @if ($story)
            <div class="card">
                <div class="card-header">
                    @lang('story.inventory_slots')
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('story.inventory_slots_help')"></x-help-block>
                    {!! Form::number('inventory_slots', $story->options ? $story->options->inventory_slots : -1, ['class' => 'form-control', 'min' => 0, 'id' => 'inventory_slots']) !!}
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                @lang('story.currency_name')
            </div>
            <div class="card-body">
                <x-help-block :help="trans('story.currency_name_help')"></x-help-block>
                <input class="form-control" type="text" id="currency_name" maxlength="15" autocomplete="nope" value="{{ $story->currency->name ?? trans('story.currency_name_default') }}">
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                @lang('story.currency_amount')
            </div>
            <div class="card-body">
                <x-help-block :help="trans('story.currency_amount_help')"></x-help-block>
                <input class="form-control" type="number" id="currency_amount" min="0" value="{{ $story && $story->options ? $story->options->currency_amount : 10 }}">
            </div>
        </div>
    </div>
</div>
