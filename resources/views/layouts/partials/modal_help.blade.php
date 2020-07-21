<div class="container container-help">
    <div class="row">
        <div>
            <h2>@lang('help.create_page_title')</h2>

            <nav class="nav nav-pills mb-2">
                <a class="nav-item nav-link active" href="#help1" data-toggle="tab">@lang('help.basics_title')</a>
                <a class="nav-item nav-link" href="#help2" data-toggle="tab">@lang('help.choices_title')</a>
                <a class="nav-item nav-link" href="#help3" data-toggle="tab">@lang('help.advanced_title')</a>
            </nav>
            <div class="tab-content">
                <div class="tab-pane active" id="help1">
                    @include('layouts.partials.help.' . app()->getLocale() . '.page_basics')
                </div>
                <div class="tab-pane" id="help2">
                    @include('layouts.partials.help.' . app()->getLocale() . '.page_choices')
                </div>
                <div class="tab-pane" id="help3">
                    @include('layouts.partials.help.' . app()->getLocale() . '.page_advanced')
                </div>
            </div>
        </div>
    </div>
</div>
