@extends('layouts.layout')

@section('title', 'Stories list')

@section('content')
    <table id="stories-table">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('admin.title') }}</th>
                <th>{{ __('common.description') }}</th>
                <th>{{ __('common.language') }}</th>
                <th>{{ __('common.author') }}</th>
                <th>{{ __('common.created_at') }}</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('common.description') }}</th>
            <th>{{ __('common.language') }}</th>
            <th>{{ __('common.author') }}</th>
            <th>{{ __('common.created_at') }}</th>
        </tr>
        </tfoot>
    </table>
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(function() {
            $('#stories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/stories/ajax_list') }}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'description'},
                    {data: 'locale'},
                    {data: 'user_id'},
                    {data: 'created_at'}
                ]
            });
        });
    </script>
@endpush
