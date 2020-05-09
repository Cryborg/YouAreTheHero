<div class="row">
    <div class="col">
        @info({!! trans('story.list_all_pages_help') !!})
        <table id="listAllPages">
            <thead>
                <tr>
                    <th class="w-25">@lang('model.title')</th>
                    <th>@lang('model.content')</th>
                    <th class="w-25">@lang('model.updated_at')</th>
                </tr>
            </thead>
            <tbody class="alternate-rows-colors">
                @foreach($pages as $page)
                    <tr data-pageid="{{ $page->id }}">
                        <td>
                            <div class="font-smaller">
                                @if ($page->is_first)
                                    <div class="badge badge-primary pull-left" data-toggle="tooltip" title="@lang('model.is_first')">
                                        <span class="glyphicon glyphicon-play"></span>
                                    </div>
                                @endif
                                @if ($page->is_checkpoint)
                                    <div class="pull-left" data-toggle="tooltip" title="@lang('model.is_checkpoint')">
                                        <span class="glyphicon glyphicon-map-marker"></span>
                                    </div>
                                @endif
                                @if ($page->is_last)
                                    <div class="pull-left" data-toggle="tooltip" title="@lang('model.is_last')">
                                        <span class="glyphicon glyphicon-fast-forward"></span>
                                    </div>
                                @endif

                                <div class="badge badge-light pull-right">
                                    {{ $page->parents->count() }} / {{ $page->choices->count() }}
                                </div>
                            </div>
                            <br>
                            <div>
                                <a href="{{ route('page.edit', ['page' => $page->id]) }}">
                                    {{ $page->title }}
                                </a>
                            </div>
                            <div class="font-smaller pull-right">
                                @if ($page->parents->count() === 0 && $page->choices->count() === 0)
                                    <span class="glyphicon glyphicon-trash text-danger clickable"></span>
                                @endif
                            </div>
                        </td>
                        <td>{!! $page->present()->content !!}</td>
                        <td class="moment_date">{{ $page->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
