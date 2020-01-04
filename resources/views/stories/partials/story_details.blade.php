<div class="card ml-4 mr-4">
    <div class="card-header">{{ trans('common.description') }}</div>
    <div class="card-body">
        <p class="card-text">%TEXT%</p>
    </div>
    <div class="card-footer text-muted">
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <a href="%PLAY_URL%" class="btn btn-primary card-link w-100 mb-1">{{ trans('story.start_playing') }}</a>
            </div>
            <div class="col-sm-12 col-lg-3">
                %EDIT_URL%
            </div>
            <div class="col-sm-12 col-lg-3">
                %RESET_STORY%
            </div>
        </div>



    </div>
    <div class="card-footer text-right text-muted">
        {{ trans('story.author_is', ['author' => '%AUTHOR%']) }}
    </div>
</div>
