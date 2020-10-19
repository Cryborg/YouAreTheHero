@info({!! trans('page.current_page_riddles_help') !!})

<h3>
    {{ trans('page.riddle_header') }}
    <button class="btn btn-success shadow ml-2" data-target="#modalCreateRiddle" data-toggle="modal">
        <span class="icon-add text-white"></span>
    </button>
</h3>

    <table class="table alternate-rows-colors" id="riddle_table">
        <tr>
            <td class="w-25">@lang('page.riddle_answer_label')</td>
            <td>{{ $page->riddle->answer ?? '-'}}</td>
        </tr>
        <tr>
            <td>@lang('page.riddle_page_text_label')</td>
            <td>{{ $page->riddle->target_page_text ?? '-' }}</td>
        </tr>
        <tr>
            <td>@lang('page.riddle_target_page_id_label')</td>
            <td class="font-italic">{{ $page->riddle->page->present()->title ?? '-' }}</td>
        </tr>
        <tr>
            <td>@lang('page.earned_item')</td>
            <td>{{ $page->riddle->item->name ?? '-' }}</td>
        </tr>
    </table>
