{!! Form::open(['route' => 'story.create.post', 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::label('title', trans('model.title'), ['class' => 'control-label']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', trans('model.description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('locale', trans('model.locale'), ['class' => 'control-label']) !!}
        {!! Form::select('locale', $locales , old('locale') , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
        {!! Form::select('layout', $layouts , old('layout') , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group form-check">
        <label>
            {!! Form::checkbox('is_published', 1, old('is_published') ?? 0,  ['id' => 'is_published']) !!}
            @lang('model.is_published')
        </label>
    </div>

    {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
{!! Form::close() !!}
