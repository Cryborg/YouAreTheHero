@extends('base')

@section('title', trans('stories.drafts_list_title'))

@section('content')
    <h1>{{ trans('stories.drafts_list_title') }}</h1>

    <table id="stories-table" class="stripe">
        <thead>
            <tr>
                <th></th>   {{-- Child rows button --}}
                <th></th>   {{-- Story ID --}}
                <th>{{ __('story.title') }}</th>
                <th>{{ __('common.language') }}</th>
                <th>{{ __('common.author') }}</th>
                <th>{{ __('common.updated_at') }}</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>{{ __('story.title') }}</th>
            <th>{{ __('common.language') }}</th>
            <th>{{ __('common.author') }}</th>
            <th>{{ __('common.updated_at') }}</th>
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

                // Backticks are mandatory here !
                var template = `{!! includeAsJsString('stories.partials.story_details') !!}`;

                var replacements = {
                    "%TEXT%":decodedString,
                    "%PLAY_URL%": '<a href="' + route('page.edit', {'page': d.last_created_page.uuid}) + '#current_page" class="btn btn-primary card-link w-100 mb-1">{{ trans('story.resume_editing') }}</a>',
                    "%EDIT_URL%": d.can_edit == true
                        ? '<a href="' + route('story.edit', {'story': d.id}) + '" class="btn btn-success card-link w-100 mb-1">{{ trans('story.edit') }}</a>'
                        : ' ',
                    "%RESET_STORY%": ' ',
                    "%AUTHOR%": d.user
                };

                return template.replace(/%\w+%/g, function(all) {
                    return replacements[all] || all;
                });
            }

            var table = $('#stories-table').DataTable({
                dom: 'rt<p><"clear">',
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
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'locale', 'width': '10%'},
                    {data: 'user', 'width': '20%'},
                    {data: 'updated_at', "render": function (data, type, row) {
                            return moment(data).fromNow();
                        }, 'width': '20%'}
                ],
                columnDefs: [
                    {
                        "targets": [ 1 ],
                        "visible": false,
                        "searchable": false
                    }
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
