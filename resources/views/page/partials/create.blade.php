{!! Form::model($page, [
    'route' => ['page.edit.post', $page->id],
    'id' => 'form-' . $page->id,
    'data-internalid' => $internalId
]) !!}
<div class="form-errors alert alert-danger hidden">

</div>
<div class="form-group">
    {!! Form::label('title', trans('model.title'), ['class' => 'control-label']) !!}
    <p class="help-block">{{ trans('model.page_title_help') }}</p>
    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    <div class="alert alert-error hidden"></div>
</div>

<div class="form-group">
    {!! Form::label('content', trans('model.content'), ['class' => 'control-label']) !!}
    <p class="help-block">{{ trans('model.page_content_help') }}</p>
    {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => 5]) !!}
    <div class="alert alert-error hidden"></div>
</div>

<div class="form-group">
    {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
    <p class="help-block">{{ trans('model.page_layout_help') }}</p>
    {!! Form::select('layout', $layouts , old('layout') , ['class' => 'form-control']) !!}
</div>

<div class="form-group form-check">
    <p class="help-block">{{ trans('model.page_is_first_help') }}</p>
    <label>
        {!! Form::checkbox('is_first', 1, $page->is_first) !!}
        @lang('model.is_first')
    </label>
</div>
<div class="form-group form-check">
    <p class="help-block">{{ trans('model.page_is_last_help') }}</p>
    <label>
        {!! Form::checkbox('is_last', 1, $page->is_last) !!}
        @lang('model.is_last')
    </label>
</div>
<div class="form-group form-check">
    <p class="help-block">{{ trans('model.page_is_checkpoint_help') }}</p>
    <label>
        {!! Form::checkbox('is_checkpoint', 1, $page->is_checkpoint) !!}
        @lang('model.is_checkpoint')
    </label>
</div>

{!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary submit-btn']) !!}
{!! Form::close() !!}
