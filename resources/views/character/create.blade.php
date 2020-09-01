@extends('base')

@section('title', $title)

@section('content')
    <h2 class="mb-3">{{ $story->title }}</h2>

    @if ($story->story_options && $story->story_options->has_character)
        {!! Form::open(['url' => route('character.create', ['story' => $story->id]), 'method' => 'post']) !!}

        <div class="form-group">
            {!! Form::label('name', trans('character.name_label'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('character.name_help') }}</p>

            <div class="col-sm-3 my-1">
                @if ($story->story_options && in_array($story->story_options->character_genre, [\App\Classes\Constants::GENRE_MALE, \App\Classes\Constants::GENRE_FEMALE]))
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                @include('partials.description', [
                                    'link_text' => '<span class="icon-' . $story->story_options->character_genre . ' font-biggest"></span>',
                                    'content' => trans('character.genre_' . $story->story_options->character_genre . '_help'),
                                    'icon' => false
                                ])
                            </div>
                        </div>
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        <div class="alert alert-danger hidden">{{ trans('character.name_error') }}</div>
                    </div>
                @elseif ($story->story_options && $story->story_options->character_genre === \App\Classes\Constants::GENRE_BOTH)
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    <div class="alert alert-danger hidden">{{ trans('character.name_error') }}</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label class="ml-4">
                                {!! Form::radio('character_genre', 'male', true) !!}
                                @lang('character.genre_male')
                                <span class="text-muted font-smaller ml-3">
                                    @lang('character.genre_male_help')
                                </span>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label class="ml-4">
                                {!! Form::radio('character_genre', 'female') !!}
                                @lang('character.genre_female')
                                <span class="text-muted font-smaller ml-3">
                                    @lang('character.genre_female_help')
                                </span>
                            </label>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    @endif

    @if ($has_visible_fields && $story->story_options && $story->story_options->has_stats)
        {!! Form::label('stats', trans('character.stats_label'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('character.stats_help') }}</p>
        <div class="row">
            <div class="col-lg-2 col-sm-6 text-center">
                @lang('field.points_left_to_share')
                <div id="points_left" data-original-value="{{ $story->story_options->points_to_share }}">{{ $story->story_options->points_to_share }}</div>
            </div>
            <div class="col-lg-10 col-sm-6">
                @foreach($story->fields as $field)
                    @if ($field->hidden === false)
                        <div class="form-group row">
                            <div class="col-sm-3 col-lg-1">
                                {{ $field->name }}
                                <small class="text-muted d-inline d-md-none">({{ trans('field.range_text', [
                                'min' => $field->min_value,
                                'max' => $field->max_value
                             ]) }})</small>
                            </div>
                            <div class="col-sm-3 col-lg-1 quantity">
                                <input name="stat_value" type="number" value="{{ old('stat_value') ?? $field->min_value }}"
                                    min="{{ $field->min_value }}" max="{{ $field->max_value }}" step="1"
                                    data-field_id="{{ $field->id }}" data-original-value="{{ old('stat_value') ?? $field->min_value }}"
                                    class="input-number w-100"/>
                            </div>
                            <small class="text-muted d-none d-md-block">({{ trans('field.range_text', [
                                'min' => $field->min_value,
                                'max' => $field->max_value
                             ]) }})</small>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <button id="save_character" class="btn btn-success submit-btn mb-1 w-100"
                type="submit" data-original-text="{{ trans('story.create_submit') }}"
                @if ($has_visible_fields && $story->fields->count() > 0) disabled @endif
            >{{ trans('story.create_submit') }}</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        @include('character.js.create-js')
    </script>
@endpush
