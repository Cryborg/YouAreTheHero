<div class="card">
    <h5 class="card-header">
        @lang('page.report.to')
    </h5>
    <div class="card-body">
        <x-help-block :help="trans('page.report.to_help')"></x-help-block>
        <select id="report_to" class="form-control">
            <option value="author">@lang('story.author')</option>
            <option value="moderator">@lang('user.roles.moderator')</option>
        </select>
    </div>
    <h5 class="card-header">
        @lang('page.report.error_type')
    </h5>
    <div class="card-body">
        <x-help-block :help="trans('page.report.error_type_help')"></x-help-block>
        <select id="report_error_type" class="form-control">
            <option value="spelling">@lang('page.report.error_type_spelling')</option>
            <option value="other">@lang('page.report.error_type_other')</option>
        </select>
    </div>
    <div class="card-header">
        @lang('page.report.comment')
    </div>
    <div class="card-body">
        <x-help-block :help="trans('page.report.comment_help')"></x-help-block>
        <textarea class="form-control w-100" id="report_comment" rows="6"></textarea>
    </div>
</div>
