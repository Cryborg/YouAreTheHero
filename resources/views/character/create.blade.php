@extends('base')

@section('title', $title)

@section('content')
    <h2 class="mb-3">{{ $story->title }}</h2>

    {!! Form::open(['url' => route('character.create', ['story' => $story->id]), 'method' => 'post']) !!}
        <div class="form-group">
            {!! Form::label('name', trans('character.name_label'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('character.name_help') }}</p>
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
        </div>

        <button class="btn btn-success submit-btn mb-1 w-50" type="submit" data-original-text="{{ trans('story.create_submit') }}">{{ trans('story.create_submit') }}</button>
    {!! Form::close() !!}
@endsection

@push('footer-scripts')
    @include('character.js.create-js')
@endpush
