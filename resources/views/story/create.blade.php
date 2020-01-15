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

        <div class="form-group hidden">
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

        <div class="form-group col-xs-12 col-lg-3">
            {!! Form::label('genres', trans('story.genres_label')) !!}
            <p class="help-block">{!! trans('story.genres_help') !!}</p>
            <select class="selectpicker" title="{{ trans('story.select_genres_placeholder') }}"
                size="6" id="genres" name="genres[]" multiple required
                data-live-search="true" data-max-options="5">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                        @foreach ($story->genres as $storyGenre)
                            @if ($storyGenre->id == $genre->id) selected @endif
                        @endforeach
                    >{{ $genre->label }}</option>
                @endforeach
            </select>
        </div>

        {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
