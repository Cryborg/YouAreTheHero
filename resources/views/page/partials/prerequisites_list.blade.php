<h3>{{ trans('page.prerequisite_title') }}</h3>
<table class="table" id="prerequisites_list-{{ $page->uuid }}">
    <thead class="thead-light">
        <th scope="col">{{ trans('page.required_type_label') }}</th>
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('item.quantity') }}</th>
        <th scope="col">{{ trans('common.actions') }}</th>
    </thead>
    <tbody>
        @foreach ($page->prerequisites() ?? [] as $prerequisite)
            <tr>
                <td>{{ trans('item.' . $prerequisite->prerequisiteable_type) }}</td>
                <td>{{ $prerequisite->prerequisiteable->name }}</td>
                <td>{{ $prerequisite->quantity }}</td>
                <td class="text-center">
                    <span class="glyphicon glyphicon-trash-red delete-prerequisite" data-prerequisite_id="{{ $prerequisite->id }}" title="{{ trans('common.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
