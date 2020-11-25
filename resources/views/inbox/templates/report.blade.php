<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <b>@lang('inbox.templates.report.story_label')</b>
            </div>
            <div class="col-6">
                {{ $page->story->title }}
            </div>
            <div class="col-6">
                <b>@lang('inbox.templates.report.page_label')</b>
            </div>
            <div class="col-6">
                <a href="{{ route('page.edit', ['page' => $page]) }}">
                    {{ $page->title }}
                </a>
            </div>
            <div class="col-6">
                <b>@lang('inbox.templates.report.error_type_label')</b>
            </div>
            <div class="col-6">
                {{ $errorType }}
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! $comment !!}
    </div>
</div>
