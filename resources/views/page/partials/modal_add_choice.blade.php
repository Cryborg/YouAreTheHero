<div class="panel panel-default">
    <div class="panel-heading">
        @lang('page.link_text')
    </div>
    <div class="panel-body">
        <input type="text" id="link_text">
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('page.existing_page')
    </div>
    <div class="panel-body">
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

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="show_new_page">
    <label class="form-check-label" for="show_new_page">
        @lang('page.show_after_create')
    </label>
</div>
