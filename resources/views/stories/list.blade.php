@extends('base')

@section('title', 'Stories list')

@section('content')
    <h1>{{ trans('stories.list_title') }}</h1>

    <table id="stories-table" class="stripe">
        <thead>
            <tr>
                <th></th>   {{-- Child rows button --}}
                <th></th>   {{-- Story ID --}}
                <th>{{ __('admin.title') }}</th>
                <th>{{ __('common.genres') }}</th>
                <th>{{ __('common.language') }}</th>
                <th>{{ __('common.author') }}</th>
                <th>{{ __('common.created_at') }}</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('common.genres') }}</th>
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
                ajax: '{{ route('stories.list.ajax', ['draft' => false]) }}',
                columns: [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": '',
                        "width":          '5%'
                    },
                    {data: 'id', render: function ( data, type, row ) {
                            return '<a href="{{ url('/story/') }}/' + data + '">' + data + '</a>';
                        }, 'width': '5%'},
                    {data: 'title'},
                    {data: 'genres', render: function ( data, type, row ) {
                            var genres = [];
                            data.forEach (function (genre) {
                                genres.push(genre.label);
                            });

                            return genres.join(', ');
                        }, 'width': '5%'},
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
