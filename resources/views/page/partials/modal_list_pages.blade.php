@info({!! trans('story.list_all_pages_help') !!})

<div class="row">
@foreach($pages as $page)
        <div class="col-12">
            <div class="card mb-3 border-secondary clickable" data-pageid="{{ $page->id }}">
                <div class="row no-gutters">
                    <div class="col-md-1 card-header text-center">
                        @if ($page->is_first)
                            <div class="badge" data-toggle="tooltip" title="@lang('model.is_first')">
                                <span class="icon-play text-black font-biggest"></span>
                            </div>
                        @endif
                        @if ($page->is_checkpoint)
                            <div class="badge" data-toggle="tooltip" title="@lang('model.is_checkpoint')">
                                <span class="icon-position-marker text-black font-biggest"></span>
                            </div>
                        @endif
                        @if ($page->is_last)
                            <div class="badge" data-toggle="tooltip" title="@lang('model.is_last')">
                                <span class="icon-checkered-flag text-black font-biggest"></span>
                            </div>
                        @endif

                        @if (!$page->is_first && $page->parents->count() === 0 && $page->choices->count() === 0)
                            <div>
                                <div class="badge">
                                    <span class="icon-trash clickable text-red deletePage font-biggest"
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
                            @can('debug')
                                <span class="badge badge-warning"><span class="font-smaller">#</span>{{ $page->id }}</span>
                            @endcan
                            {{ $page->title }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $page->present()->short_content !!}</p>
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

