@info({!! trans('story.list_all_pages_help') !!})

<div class="row">
@foreach($pages as $page)
        <div class="col-sm-6">
            <div class="card mb-3 border-secondary clickable" data-pageid="{{ $page->id }}">
                <div class="row no-gutters">
                    <div class="col-md-1 card-header text-center">
                        @if ($page->is_first)
                            <div class="badge badge-primary w-100" data-toggle="tooltip" title="@lang('model.is_first')">
                                <span class="glyphicon glyphicon-play"></span>
                            </div>
                        @endif
                        @if ($page->is_checkpoint)
                            <div class="badge badge-success w-100 text-white" data-toggle="tooltip" title="@lang('model.is_checkpoint')">
                                <span class="glyphicon glyphicon-map-marker"></span>
                            </div>
                        @endif
                        @if ($page->is_last)
                            <div class="badge badge-success w-100" data-toggle="tooltip" title="@lang('model.is_last')">
                                <span class="glyphicon glyphicon-fast-forward"></span>
                            </div>
                        @endif

                            @if ($page->parents->count() === 0 && $page->choices->count() === 0)
                                <div class="badge badge-danger font-smaller w-100">
                                    <span class="glyphicon glyphicon-trash clickable"
                                        data-pageid="{{ $page->id }}"
                                        data-toggle="tooltip" title="@lang('common.delete')"
                                    ></span>
                                </div>
                            @endif

                    </div>
                    <div class="col-md-11">
                        <div class="card-header">
                            {{ $page->title }}
                            <div class="font-smaller">
                                <div class="badge badge-light pull-right">
                                    {{ $page->parents->count() }} / {{ $page->choices->count() }}
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $page->present()->content !!}</p>
                            <p class="card-text text-right"><small class="text-muted moment_date">{{ $page->updated_at }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
</div>

