<div class="card">
    <h5 class="card-header">
        @lang('page.link_text')
    </h5>
    <div class="card-body">
        <div class="card-text">
            <p class="help-block">@lang('page.link_text_help')</p>
            <input type="text" id="link_text" class="w-100">
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header">
        @lang('page.existing_page') <span class="badge badge-light text-muted">@lang('common.optional')</span>
    </h5>
    <div class="card-body">
        <div class="card-text">
            <p class="help-block">@lang('page.link_page_help')</p>
            <select class="form-control mr-sm-2 childrenSelect" data-page-from="{{ $page->id }}">
                <option value="0" selected>{{ trans('page.existing_page') }}</option>
                @foreach ($page->getPotentialChildren() as $existingPage)
                    @if ($existingPage->id !== $page->id)
                        <option value="{{ $existingPage->id }}">{{ $existingPage->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>

<p class="help-block">@lang('page.show_new_page_help')</p>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="show_new_page" checked>
    <label class="form-check-label" for="show_new_page">
        @lang('page.show_after_create')
    </label>
</div>
