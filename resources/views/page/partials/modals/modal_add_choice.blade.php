<div class="card">
    <h5 class="card-header">
        @lang('page.link_text')
    </h5>
    <div class="card-body">
        <div class="card-text">
            <x-help-block :help="trans('page.link_text_help')"></x-help-block>
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
            <x-help-block :help="trans('page.link_page_help')"></x-help-block>
            <select class="form-control mr-sm-2 childrenSelect" data-page-from="{{ $page->id }}">
                <option value="0" selected>{{ trans('page.existing_page') }}</option>
                @foreach ($page->getPotentialChildren() as $existingPage)
                    @if ($existingPage->id !== $page->id)
                        <option value="{{ $existingPage->id }}">{{ $existingPage->present()->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <x-help-block :help="trans('page.show_new_page_help')"></x-help-block>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="show_new_page" checked>
            <label class="form-check-label" for="show_new_page">
                @lang('page.show_after_create')
            </label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hide_choice" value="1">
            <label class="form-check-label" for="hide_choice">@lang('page.hide_unavailable_choice')</label>
        </div>
    </div>
</div>
