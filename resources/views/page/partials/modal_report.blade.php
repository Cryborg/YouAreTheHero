<div class="card">
    <h5 class="card-header">
        @lang('page.report_error_type')
    </h5>
    <div class="card-body">
        <p class="help-block">@lang('page.report_error_type_help')</p>
        <select id="report_error_type" class="form-control">
            <option value="spelling">@lang('page.report_error_type_spelling')</option>
            <option value="other">@lang('page.report_error_type_other')</option>
        </select>
    </div>
    <div class="card-header">
        @lang('page.report_comment')
    </div>
    <div class="card-body">
        <p class="help-block">@lang('page.report_comment_help')</p>
        <textarea class="form-control w-100" id="report_comment" rows="6"></textarea>
    </div>
</div>
