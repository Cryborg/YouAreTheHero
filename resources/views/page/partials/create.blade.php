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
        {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
        {!! Form::select('layout', $layouts , old('layout') , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group form-check">
        <label>
            {!! Form::checkbox('is_first', old('is_first') ?? '0', null,  ['id' => 'is_first']) !!}
            @lang('model.is_first')
        </label>
    </div>
    <div class="form-group form-check">
        <label>
            {!! Form::checkbox('is_last', old('is_last') ?? '0', null,  ['id' => 'is_last']) !!}
            @lang('model.is_last')
        </label>
    </div>

    {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
{!! Form::close() !!}
