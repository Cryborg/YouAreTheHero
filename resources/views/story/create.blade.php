@extends('base')

@section('title', $title)

@section('content')

    <h1>{{ $story ? trans('story.edit_title') : trans('story.create_title') }}</h1>

    {!! Form::model(\App\Models\Story::class, array('route' => array($route, $param))) !!}
        <div class="form-group">
            {!! Form::label('title', trans('model.title'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('model.story_title_help') }}</p>
            {!! Form::text('title', $story ? $story->title : old('title'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', trans('model.description'), ['class' => 'control-label']) !!}
            <p class="help-block">{{ trans('model.description_help') }}</p>
            {!! Form::textarea('description', $story ? $story->description : old('description'), ['class' => 'form-control', 'rows' => 5]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('locale', trans('model.locale'), ['class' => 'control-label']) !!}
            {!! Form::select('locale', $locales , $story ? $story->locale : old('locale') , ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
            {!! Form::select('layout', $layouts , $story ? $story->layout : old('layout') , ['class' => 'form-control']) !!}
        </div>

        @if (Route::current()->getName() === 'story.edit')
            <div class="form-group form-check">
                <label>
                    {!! Form::checkbox('is_published', $story ? $story->is_published : old('is_published') ?? 1, false, ['id' => 'is_published']) !!}
                    @lang('model.is_published')
                </label>
            </div>
        @endif

        {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
