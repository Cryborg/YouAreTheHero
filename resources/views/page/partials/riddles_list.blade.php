<h3>{{ trans('page.riddle_header') }}</h3>

@if ($page->riddle)
    <table class="dataTable alternate-rows-colors">
        <tr>
            <td class="w-25">@lang('page.riddle_answer_label')</td>
            <td>{{ $page->riddle->answer }}</td>
        </tr>
        @if ($page->riddle->target_page)
            <tr>
                <td>@lang('page.riddle_target_text_label')</td>
                <td>{{ $page->riddle->target_text }}</td>
            </tr>
            <tr>
                <td>@lang('page.riddle_target_page_label')</td>
                <td>{{ $page->riddle->target_page }}</td>
            </tr>
        @endif
        @if ($page->riddle->item_id)
            <tr>
                <td>@lang('page.concerned_item')</td>
                <td>{{ $page->riddle->item->name }}</td>
            </tr>
        @endif
    </table>
@endif
