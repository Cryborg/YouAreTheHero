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
                    <tr data-pageid="{{ $page->uuid }}">
                        <td>
                            @if ($page->is_first)
                                <div class="badge badge-pill badge-primary" data-toggle="tooltip" title="@lang('model.is_first')">
                                    <span class="glyphicon glyphicon-play"></span>
                                </div>
                            @endif
                            @if ($page->is_checkpoint)
                                <div class="badge badge-pill badge-secondary" data-toggle="tooltip" title="@lang('model.is_checkpoint')">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                            @endif
                                @if ($page->is_last)
                                    <div class="badge badge-pill badge-danger" data-toggle="tooltip" title="@lang('model.is_last')">
                                        <span class="glyphicon glyphicon-fast-forward"></span>
                                    </div>
                                @endif
                            {{ $page->title }}
                        </td>
                        <td>{!! $page->present()->content !!}</td>
                        <td>{{ $page->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
