<table class="datatable w-100">
    <thead>
        <tr>
            <td>Type</td>
            <td>Date</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($activities as $activity)
            <tr>
                <td>{{ trans('activity.' . $activity->log_name) }}</td>
                <td class="moment_date" data-sort="{{ $activity->created_at }}">{{ $activity->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
