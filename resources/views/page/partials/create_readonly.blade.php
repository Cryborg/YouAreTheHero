<a data-toggle="tooltip" title="{{ trans('page.edit_help') }}" class="btn btn-primary ml-1 w-25 mb-4" href="{{ route('page.edit', $page->uuid) }}">{{ trans('page.edit') }}</a>

<div class="form-group">
    {!! Form::label('title-' . $page->uuid, trans('model.title'), ['class' => 'control-label']) !!}
    <div class="false-input">{{ $page->title }}</div>
</div>

<div class="form-group">
    {!! Form::label('content-' . $page->uuid, trans('model.content'), ['class' => 'control-label']) !!}
    <div class="false-input">{!! $page->content !!}</div>
</div>

<div class="form-group form-check">
    <label>
        {!! Form::checkbox('is_first', 1, $page->is_first, ['disabled' => true]) !!}
        @lang('model.is_first')
    </label>
</div>
{{-- Can't be the last one as it is a parent --}}
{{--<div class="form-group form-check">--}}
{{--    <label>--}}
{{--        {!! Form::checkbox('is_last', 1, $page->is_last, ['disabled' => true]) !!}--}}
{{--        @lang('model.is_last')--}}
{{--    </label>--}}
{{--</div>--}}
<div class="form-group form-check">
    <label>
        {!! Form::checkbox('is_checkpoint', 1, $page->is_checkpoint, ['disabled' => true]) !!}
        @lang('model.is_checkpoint')
    </label>
</div>
