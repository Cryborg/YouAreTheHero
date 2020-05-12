<h3>{{ trans('page.riddle_header') }}</h3>

@if ($page->riddle)
    <table class="table alternate-rows-colors" id="riddle_table">
        <tr>
            <td class="w-25">@lang('page.riddle_answer_label')</td>
            <td>{{ $page->riddle->answer }}</td>
        </tr>
        @if ($page->riddle->target_page_id)
            <tr>
                <td>@lang('page.riddle_page_text_label')</td>
                <td>{{ $page->riddle->target_page_text }}</td>
            </tr>
            <tr>
                <td>@lang('page.riddle_target_page_id_label')</td>
                <td class="font-italic">{{ $page->riddle->page->title }}</td>
            </tr>
        @endif
        @if ($page->riddle->item)
            <tr>
                <td>@lang('page.earned_item')</td>
                <td>{{ $page->riddle->item->name }}</td>
            </tr>
        @endif
    </table>
@endif
