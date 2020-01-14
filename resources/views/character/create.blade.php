@extends('base')

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

            {!! Form::label('stats', trans('character.stats_label'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('character.stats_help') }}</p>

            @foreach($story->sheet as $stat)
                <div class="form-group row">
                    <div class="col-sm-3 col-lg-1">{{ $stat->stat_full_name }}</div>
                    <div class="col-sm-3 col-lg-1">
                        {{ Form::number('stat_value', old('stat_value') ?? $stat->stat_min_value, [
                            'class' => 'form-control',
                            'min' => $stat->stat_min_value,
                            'max' => $stat->stat_max_value,
                            'data-stat_name' => $stat->stat_full_name
                        ]) }}
                    </div>
                </div>
            @endforeach

        <button class="btn btn-success submit-btn mb-1 w-50" type="submit" data-original-text="{{ trans('story.create_submit') }}">{{ trans('story.create_submit') }}</button>
    {!! Form::close() !!}
@endsection

@push('footer-scripts')
    @include('character.js.create-js')
@endpush
