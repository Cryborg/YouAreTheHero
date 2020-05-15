@info({!! trans('story.list_all_pages_help') !!})

<div class="row">
@foreach($pages as $page)
        <div class="col-12">
            <div class="card mb-3 border-secondary clickable"
                data-pageid="{{ $page->id }}">
                <div class="row no-gutters">
                    <div class="col-md-1 card-header text-center">
                        @if ($page->is_first)
                            <div class="badge badge-primary" data-toggle="tooltip" title="@lang('model.is_first')">
                                <span class="glyphicon glyphicon-play"></span>
                            </div>
                        @endif
                        @if ($page->is_checkpoint)
                            <div class="badge badge-success text-white" data-toggle="tooltip" title="@lang('model.is_checkpoint')">
                                <span class="glyphicon glyphicon-map-marker"></span>
                            </div>
                        @endif
                        @if ($page->is_last)
                            <div class="badge badge-success" data-toggle="tooltip" title="@lang('model.is_last')">
                                <span class="glyphicon glyphicon-fast-forward"></span>
                            </div>
                        @endif

                        @if (!$page->is_first && $page->parents->count() === 0 && $page->choices->count() === 0)
                            <div>
                            <div class="badge badge-danger">
                                <span class="icon-trash clickable text-white"
                                    data-pageid="{{ $page->id }}"
                                    data-toggle="tooltip" title="@lang('common.delete')"
                                ></span>
                            </div>
                            </div>
                        @endif

                        <div class="align-bottom">
                            <small class="text-muted moment_date">{{ $page->updated_at }}</small>
                        </div>
                    </div>

                    <div class="col-md-11">
                        <div class="card-header">
                            {{ $page->title }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $page->present()->content !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col">
                        <div class="card-footer">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="button-group">
                                    <button class="button button-preview"
                                        @if ($page->parents->count() === 0)
                                            disabled
                                        @else
                                            data-parents="{{ $page->parents->pluck('id') }}"
                                        @endif
                                        >@choice('page.number_parents', $page->parents->count())</button>
                                    <button class="button button-preview"
                                        @if ($page->choices->count() === 0)
                                            disabled
                                        @else
                                            data-choices="{{ $page->choices->pluck('id') }}"
                                        @endif
                                        >@choice('page.number_choices', $page->choices->count())</button>
                                </div>
                                <div class="button-group">
                                    <a href="{{ route('page.edit', ['page' => $page]) }}" class="button">
                                        <span class="icon-fountain-pen"></span>
                                        @lang('page.edit')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
</div>

