<div class="row">
    <div class="col">
        @info({!! trans('story.list_all_pages_help') !!})
        <table>
            <thead>
                <tr>
                    <th>@lang('model.title')</th>
                    <th>@lang('model.content')</th>
                </tr>
            </thead>
            <tbody class="alternate-rows-colors">
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{!! $page->present()->content !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
