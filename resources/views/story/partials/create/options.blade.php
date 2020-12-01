<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                @lang('character.character_label')
            </div>
            <div class="card-body">
                <x-help-block :help="trans('story.has_character_help')"></x-help-block>
                <div class="form-group form-check ml-3">
                    <input class="form-check-input" type="checkbox" value="1" id="has_character" name="has_character" @if ($story && $story->options && $story->options->has_character) checked @endif
                    > <label class="form-check-label" for="has_character">
                        {{ trans('story.has_character_label') }}
                    </label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="character_genre"
                            value="male" id="genre_male" @if ($story && $story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_MALE) checked @endif>
                        <label for="genre_male" class="form-check-label">@lang('character.genre_male')</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="character_genre"
                            value="female" id="genre_female" @if ($story && $story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_FEMALE) checked @endif>
                        <label for="genre_female" class="form-check-label">@lang('character.genre_female')</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="character_genre"
                            value="both" id="genres_both" @if ($story && $story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_BOTH) checked @endif>
                        <label for="genres_both" class="form-check-label">@lang('story.genres_both')</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                @lang('field.sheet')
            </div>
            <div class="card-body">
                <x-help-block :help="trans('story.has_stats_help')"></x-help-block>
                <div class="form-group form-check ml-3">
                    <input class="form-check-input" type="checkbox" value="1" id="has_stats" name="has_stats" @if ($story && $story->options && $story->options->has_stats) checked @endif
                    > <label class="form-check-label" for="has_stats">
                        {{ trans('story.has_stats_label') }}
                    </label>
                </div>
            </div>
        </div>
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
