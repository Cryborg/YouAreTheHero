<div class="container container-help">
    <div class="row">
        <div>
            <h2>@lang('help.create_page_title')</h2>

            <nav class="nav nav-pills mb-4">
                <a class="nav-item nav-link active" href="#help1" data-toggle="tab">@lang('help.basics_title')</a>
                <a class="nav-item nav-link" href="#help2" data-toggle="tab">
                    <span class="icon-choice mr-2"></span>
                    @lang('help.choices_title')
                </a>
                <a class="nav-item nav-link" href="#help3" data-toggle="tab">@lang('help.gameplay_title')</a>
                <a class="nav-item nav-link" href="#help4" data-toggle="tab">@lang('help.advanced_editor_title')</a>
            </nav>
            <div class="tab-content">
                <div class="tab-pane active" id="help1">
                    <x-help :page="'page_basics'"/>
                </div>
                <div class="tab-pane" id="help2">
                    <x-help :page="'page_choices'"/>
                </div>
                <div class="tab-pane" id="help3">
                    <x-help :page="'page_advanced'"/>
                </div>
                <div class="tab-pane" id="help4">
                    <x-help :page="'page_advanced_editor'"/>
                </div>
            </div>
        </div>
    </div>
</div>
