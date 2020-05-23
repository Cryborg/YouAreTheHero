<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            @info({!! trans('page.descriptions_help') !!})

            <div class="card">
                <div class="card-header"">
                    @lang('description.keyword')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('description.keyword_help')</p>
                    <input type="text" id="keyword">
                </div>
                <div class="card-header">
                    @lang('description.description')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('description.description_help')</p>
                    <textarea id="description" class="summernote"></textarea>
                </div>
            </div>
            <button class="btn btn-primary mb-3" id="save_description">@lang('common.save')</button>
        </div>
        <div class="col-lg-6 col-md-12 scrollable-content h-600px" id="descriptions_list">
            @info({!! trans('description.descriptions_list_help') !!})

            @foreach($descriptions as $description)
                <div class="card" data-description-id="{{ $description->id }}">
                    <h5 class="card-header">
                        <button type="button" class="close ml-2 deleteDescription">
                            <span class="icon-trash text-red"></span>
                        </button>
                        <button type="button" class="close edit">
                        <button type="button" class="close editDescription">
                            <span class="icon-fountain-pen"></span>
                        </button>

                        <div id="keyword_{{ $description->id }}">{{ $description->keyword }}</div>
                    </h5>
                    <div class="card-body">
                        <div id="description_{{ $description->id }}">{!! $description->description !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
