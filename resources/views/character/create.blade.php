@extends('base')

@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/input_number.css') }}"/>
@endpush

@section('title', $title)

@section('content')
    <h2 class="mb-3">{{ $story->title }}</h2>

    {!! Form::open(['url' => route('character.create', ['story' => $story->id]), 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::label('name', trans('character.name_label'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('character.name_help') }}</p>
        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
        <div class="alert alert-error hidden">{{ trans('character.name_error') }}</div>
    </div>

    @if ($story->stat_stories->count() > 0)
        {!! Form::label('stats', trans('character.stats_label'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('character.stats_help') }}</p>
        <div class="row">
            <div class="col-2 text-center">
                {{ trans('stat.points_left_to_share') }}:
                <div id="points_left">{{ $story->points_to_share }}</div>
            </div>
            <div class="col">
                @foreach($story->stat_stories as $stat)
                    <div class="form-group row">
                        <div class="col-sm-3 col-lg-1">{{ $stat->full_name }}</div>
                        <div class="col-sm-3 col-lg-1 quantity">
                            {{ Form::number('stat_value', old('stat_value') ?? $stat->min_value, [
                                'class' => 'form-control',
                                'min' => $stat->min_value,
                                'max' => $stat->max_value,
                                'data-stat_id' => $stat->id,
                                'onkeydown' => 'return false'
                            ]) }}
                        </div>
                        <small class="text-muted">({{ trans('stat.range_text', [
                            'min' => $stat->min_value,
                            'max' => $stat->max_value
                             ]) }})</small>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <button id="save_character" class="btn btn-success submit-btn mb-1 w-50"
        type="submit" data-original-text="{{ trans('story.create_submit') }}"
        @if ($story->stat_stories->count() > 0) disabled @endif
        >{{ trans('story.create_submit') }}</button>
    {!! Form::close() !!}
@endsection

@push('footer-scripts')
    @include('character.js.create-js')
@endpush
