<div class="card ml-4 mr-4">
    <div class="card-header">{{ trans('common.description') }}</div>
    <div class="card-body">
        <p class="card-text">%TEXT%</p>
    </div>
    <div class="card-footer text-muted">
        <a href="%PLAY_URL%" class="btn btn-primary card-link">{{ trans('story.start_playing') }}</a>
        %EDIT_URL%
        %RESET_STORY%
    </div>
    <div class="card-footer text-right text-muted">
        {{ trans('story.author_is', ['author' => '%AUTHOR%']) }}
    </div>
</div>
