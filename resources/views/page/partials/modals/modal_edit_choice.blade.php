<input type="hidden" id="hidden_choice_id">

<div class="card">
    <h5 class="card-header">
        @lang('page.link_text')
    </h5>
    <div class="card-body">
        <div class="card-text">
            <p class="help-block">@lang('page.link_text_help')</p>
            <input type="text" id="edit_link_text" class="w-100">
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hide_choice" value="1">
            <label class="form-check-label" for="hide_choice">@lang('page.hide_unavailable_choice')</label>
        </div>
    </div>
</div>
