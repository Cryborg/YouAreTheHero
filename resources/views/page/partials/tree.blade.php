<div class="row">
    <div class="col-lg-4 col-md-12 p-0">
        <div class="card">
            <div class="card-header">
                <span tabindex="0" class="icon-help" data-toggle="popover" data-trigger="hover"
                    title="@lang('page.parents_label')" data-content="{{ trans('page.parents_label_help') }}"></span>
                @lang('page.parents_label')
            </div>
            <div class="card-body">
                @foreach ($page->parents as $parent)
                    <div>
                        <a class="btn btn-light btn-sm" href="{{ route('page.edit', ['page' => $parent]) }}">
                            <span class="icon-fountain-pen"></span>
                        </a>
                        {{ $parent->title }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 p-0">
        <div class="card">
            <div class="card-header">
                <span tabindex="0" class="icon-help" data-toggle="popover" data-trigger="hover"
                    title="@lang('page.siblings_label')" data-content="{{ trans('page.siblings_label_help') }}"></span>
                @lang('page.siblings_label')
            </div>
            <div class="card-body">
                @foreach ($page->parents as $parent)
                    @foreach ($parent->choices as $choice)
                        @if ($choice->id !== $page->id)
                            <div>
                                <a class="btn btn-light btn-sm" href="{{ route('page.edit', ['page' => $choice]) }}">
                                    <span class="icon-fountain-pen"></span>
                                </a>
                                <span data-toggle="popover" data-trigger="hover" data-content="{{ trans('page.link_text_is', ['link_text' => $choice->pivot->link_text, 'choice_title' => $choice->title]) }}" title="@lang('page.link_text')">
                                    {{ $choice->title }}
                                </span>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 p-0">
        <div class="card">
            <div class="card-header">
                        <span tabindex="0" class="icon-help" data-toggle="popover" data-trigger="hover"
                            title="@lang('page.children_label')" data-content="{{ trans('page.children_label_help') }}"></span>
                @lang('page.children_label')
            </div>
            <div class="card-body">
                @foreach ($page->choices as $choice)
                    <div class="choices_list">
                        <a class="btn btn-light btn-sm" href="{{ route('page.edit', ['page' => $choice]) }}">
                            <span class="icon-fountain-pen"></span>
                        </a>
                        <div class="btn btn-light btn-sm"
                            data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.delete_link')">
                            <span class="thead-light icon-breaking-chain text-red" data-pageid="{{ $choice->id }}" data-page-from="{{ $page->id }}"></span>
                        </div>
                        <span data-toggle="popover" data-trigger="hover" data-content="{!! trans('page.link_text_is', ['link_text' => $choice->pivot->link_text, 'choice_title' => $choice->title]) !!}" title="@lang('page.link_text')">
                            {{ $choice->title }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
