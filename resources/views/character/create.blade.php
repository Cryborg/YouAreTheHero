@extends('base')

@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/input_number.css') }}"/>
@endpush

@section('title', $title)

@section('content')
    <h2 class="mb-3">{{ $story->title }}</h2>

    @if ($story->story_options && $story->story_options->has_character)
        {!! Form::open(['url' => route('character.create', ['story' => $story->id]), 'method' => 'post']) !!}
        <div class="form-group">
            {!! Form::label('name', trans('character.name_label'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('character.name_help') }}</p>
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            <div class="alert alert-error hidden">{{ trans('character.name_error') }}</div>
        </div>
    @endif

    @if ($story->story_options && $story->story_options->has_stats)
        {!! Form::label('stats', trans('character.stats_label'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('character.stats_help') }}</p>
        <div class="row">
            <div class="col-2 text-center">
                {{ trans('field.points_left_to_share') }}:
                <div id="points_left">{{ $story->story_options->points_to_share }}</div>
            </div>
            <div class="col">
                @foreach($story->fields as $field)
                    @if ($field->hidden === false)
                        <div class="form-group row">
                            <div class="col-sm-3 col-lg-1">{{ $field->name }}</div>
                            <div class="col-sm-3 col-lg-1 quantity">
                                {{ Form::number('stat_value', old('stat_value') ?? $field->min_value, [
                                    'class' => 'form-control',
                                    'min' => $field->min_value,
                                    'max' => $field->max_value,
                                    'data-field_id' => $field->id,
                                    'onkeydown' => 'return false'
                                ]) }}
                            </div>
                            <small class="text-muted">({{ trans('field.range_text', [
                            'min' => $field->min_value,
                            'max' => $field->max_value
                             ]) }})</small>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <button id="save_character" class="btn btn-success submit-btn mb-1 w-50"
        type="submit" data-original-text="{{ trans('story.create_submit') }}"
        @if ($story->fields->count() > 0) disabled @endif
        >{{ trans('story.create_submit') }}</button>
    {!! Form::close() !!}
@endsection

@push('footer-scripts')
    @include('character.js.create-js')
@endpush
