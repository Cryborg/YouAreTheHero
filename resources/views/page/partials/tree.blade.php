<div class="tree">
    <table class="table table-sm" id="pages_tree">
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    <span tabindex="0" class="glyphicon glyphicon-question-sign" data-toggle="popover" data-trigger="hover"
                            title="@lang('page.parents_label')" data-content="{{ trans('page.parents_label_help') }}"></span>
                    @lang('page.parents_label')
                </th>
                <th scope="col">
                    <span tabindex="0" class="glyphicon glyphicon-question-sign" data-toggle="popover" data-trigger="hover"
                            title="@lang('page.siblings_label')" data-content="{{ trans('page.siblings_label_help') }}"></span>
                    @lang('page.siblings_label')
                </th>
                <th scope="col">
                    <span tabindex="0" class="glyphicon glyphicon-question-sign" data-toggle="popover" data-trigger="hover"
                            title="@lang('page.children_label')" data-content="{{ trans('page.children_label_help') }}"></span>
                    @lang('page.children_label')
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($page->parents as $parent)
                        <div>
                            <a class="btn btn-light btn-sm" href="{{ route('page.edit', ['page' => $parent]) }}">
                                <span class="icon-fountain-pen"></span>
                            </a>
                            {{ $parent->title }}
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach ($page->parents as $parent)
                        @foreach ($parent->choices as $choice)
                            @if ($choice->id !== $page->id)
                                <div>
                                    <a class="btn btn-light btn-sm" href="{{ route('page.edit', ['page' => $choice]) }}">
                                        <span class="icon-fountain-pen"></span>
                                    </a>
                                    <span class="badge badge-light border border-dark">{{ $choice->pivot->link_text }}</span>
                                    {{ $choice->title }}
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td>
                    @foreach ($page->choices as $choice)
                        <div class="choices_list">
                            <a class="btn btn-light btn-sm" href="{{ route('page.edit', ['page' => $choice]) }}">
                                <span class="icon-fountain-pen"></span>
                            </a>
                            <div class="btn btn-light btn-sm"
                                data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.delete_link')">
                                <span class="icon-breaking-chain text-red" data-pageid="{{ $choice->id }}" data-page-from="{{ $page->id }}"></span>
                            </div>
                            <span class="badge badge-light border border-dark">{{ $choice->pivot->link_text }}</span>
                            {{ $choice->title }}
                        </div>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>
