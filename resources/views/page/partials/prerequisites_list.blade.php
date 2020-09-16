<table class="table" id="prerequisites_list-{{ $page->id }}">
    <thead class="thead-lightblue">
        <th scope="col">{{ trans('page.required_type_label') }}</th>
        <th scope="col">{{ trans('item.category') }}</th>
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col" class="text-center">{{ trans('common.actions') }}</th>
    </thead>
    <tbody class="alternate-rows-colors">
        @foreach ($page->prerequisites() ?? [] as $prerequisite)
            <tr>
                <td>{{ trans('item.' . $prerequisite->prerequisiteable_type) }}</td>
                <td>
                    @if ($prerequisite->prerequisiteable_type === 'item')
                        {{ $prerequisite->prerequisiteable->category }}
                    @endif
                </td>
                <td>
                    @if ($prerequisite->prerequisiteable->hidden)
                        <span class="icon-eye text-lightgrey" title="@lang('item.hidden')"></span>
                    @endif
                    {{ $prerequisite->prerequisiteable->name }}
                </td>
                <td>{{ $prerequisite->quantity }}</td>
                <td class="text-center">
                    <span class="icon-trash text-danger clickable deletePrerequisite" data-prerequisite_id="{{ $prerequisite->id }}" title="{{ trans('common.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
