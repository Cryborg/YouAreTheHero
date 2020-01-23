<div class="divAsForm" data-internalid="{{ $internalId }}"
     data-route="{{ route('page.edit.post', $page->uuid) }}">

    {{--  Errors --}}
    <div class="form-errors alert alert-danger hidden"></div>
    {!! Form::hidden('internalid', $internalId, ['name' => 'internalid']) !!}

    {{-- Form --}}
    <div class="form-group mt-4">
        {!! Form::label('title-' . $internalId, trans('model.title'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('model.page_title_help') }}</p>
        {!! Form::text('title-' . $internalId, $page->title ?? old('title'), ['class' => 'form-control']) !!}
        <div class="alert alert-error hidden"></div>
    </div>

    <div class="form-group">
        {!! Form::label('content-' . $internalId, trans('model.content'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('model.page_content_help') }}</p>
        {!! Form::textarea('content-' . $internalId, $page->content ?? old('content'), ['class' => 'form-control', 'rows' => 5]) !!}
        <div class="alert alert-error hidden"></div>
    </div>

    <div class="form-group hidden">
        {!! Form::label('layout-' . $internalId, trans('model.layout'), ['class' => 'control-label']) !!}
        <p class="help-block">{{ trans('model.page_layout_help') }}</p>
        {!! Form::select('layout-' . $internalId, $layouts , $page->layout ?? old('layout') , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group form-check hidden">
        <p class="help-block">{{ trans('model.page_is_first_help') }}</p>
        <label>
            {!! Form::checkbox('is_first-' . $internalId, 1, $page->is_first or false, ['id' => 'is_first-' . $internalId]) !!}
            @lang('model.is_first')
        </label>
    </div>
    @if ($page->choices() && $page->choices()->count() === 0 && !$page->is_first)
        <div class="form-group form-check">
            <p class="help-block">{{ trans('model.page_is_last_help') }}</p>
            <label>
                {!! Form::checkbox('is_last-' . $internalId, 1, $page->is_last or false, ['id' => 'is_last-' . $internalId]) !!}
                @lang('model.is_last')
            </label>
        </div>
    @endif
    <div class="form-group form-check">
        <p class="help-block">{{ trans('model.page_is_checkpoint_help') }}</p>
        <label>
            {!! Form::checkbox('is_checkpoint-' . $internalId, 1, $page->is_checkpoint or false, ['id' => 'is_checkpoint-' . $internalId]) !!}
            @lang('model.is_checkpoint')
        </label>
    </div>

    <button class="btn btn-success submit-btn mb-1 w-50" data-original-text="{{ trans('story.create_submit') }}">{{ trans('story.create_submit') }}</button>
</div>

@if ($internalId > 0)
    <a data-toggle="tooltip" title="{{ trans('page.edit_help') }}" class="btn btn-primary w-25" href="{{ route('page.edit', $page->uuid) }}#current_page">{{ trans('page.edit') }}</a>
@endif

<button class="btn btn-danger mr-1 w-25" disabled><span class="fa fa-trash mr-1"></span>Supprimer</button>
