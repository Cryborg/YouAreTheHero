@extends('base')

@section('title', trans('stories.drafts_list_title'))

@section('content')
    <h1>{{ trans('stories.drafts_list_title') }}</h1>

    <table id="stories-table" class="stripe">
        <thead>
            <tr>
                <th></th>   {{-- Child rows button --}}
                <th></th>   {{-- Story ID --}}
                <th></th>   {{-- Link to last page edit --}}
                <th>{{ __('admin.title') }}</th>
                <th>{{ __('common.language') }}</th>
                <th>{{ __('common.author') }}</th>
                <th>{{ __('common.created_at') }}</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ __('admin.title') }}</th>
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
            function format ( d ) {
                var parser = new DOMParser;
                var dom = parser.parseFromString(d.description, 'text/html');
                var decodedString = dom.body.textContent;

                return '<div class="card-body">' + decodedString + '</div>';
            }

            var table = $('#stories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('stories.list.ajax', ['draft' => true]) }}',
                columns: [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": '',
                        "width":          '5%'
                    },
                    {data: 'id', render: function ( data, type, row ) {
                            return '<a href="' + route('story.edit', data) + '">' + data + '</a>';
                        }, 'width': '5%'},
                    {data: 'last_created_page', render: function ( data, type, row ) {
                            return '<a href="' + route('page.edit', data.id) + '#current_page">{{ trans('story.resume_editing') }}</a>';
                        }, 'width': '5%'},
                    {data: 'title'},
                    {data: 'locale', 'width': '10%'},
                    {data: 'user_id', 'width': '20%'},
                    {data: 'created_at', 'width': '20%'}
                ]
            });

            // Add event listener for opening and closing details
            $('#stories-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()), tr.hasClass('odd') ? 'odd' : '' ).show();
                    tr.addClass('shown');
                }
            } );
        });
    </script>
@endpush
