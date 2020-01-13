<table class="table" id="prerequisites_list">
    <thead class="thead-light">
        <th scope="col">{{ trans('page.required_type') }}</th>
        <th scope="col">{{ trans('item.name') }}</th>
        <th scope="col">{{ trans('common.actions') }}</th>
    </thead>
    <tbody>
        @foreach ($page->prerequisites() ?? [] as $prerequisite)
            <tr>
                <td>{{ trans('item.item') }}</td>
                <td>{{ $prerequisite->prerequisiteable->name }}</td>
                <td class="text-center">
                    <span class="glyphicon glyphicon-trash delete-prerequisite" data-prerequisite_id="{{ $prerequisite->id }}" title="{{ trans('admin.delete') }}"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
