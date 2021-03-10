<div class="card">
    <div class="card-header">
        <i class="icon-star text-warning"></i>
        {{ trans('story.rating.title') }}
    </div>
    <div class="card-body">
        <x-help-block :help="trans('story.rating.description')"></x-help-block>

        <div class="form-group">
            <label for="storyRates">{{ trans('story.rating.rate') }}</label>
            <select class="form-control" id="storyRates">
                <option value="0">{{ trans('story.rating.no_rating') }}</option>

                @for($rate = 1; $rate <= 5; $rate += .5)
                    <option value="{{ $rate }}" @if ($story->userAverageRating() == $rate) selected @endif>{{ $rate }}
                        @if($rate == (int) $rate)
                            {{ trans('story.rating.rates.' . $rate) }}
                        @endif
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="rateComment">{{ trans('story.rating.comment') }}</label>
            <textarea class="form-control" id="rateComment" rows="5">@if(optional($story->ratings->first())->comment){{ $story->ratings->first()->comment }}@endif</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-success" id="rateStory">{{ trans('story.rating.button') }}</button>
        </div>
    </div>
</div>
