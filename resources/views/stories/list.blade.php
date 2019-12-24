@extends('base')

@section('title', 'Stories list')

@section('content')
    <h1>{{ trans('stories.list_title') }}</h1>

    <fieldset class="ml-2">
        <legend>{{ trans('common.filters') }}</legend>

        <div class="form-group row ml-2">
            {!! Form::label('languages', trans('common.language'), ['class' => 'control-label col-2']) !!}
            {!! Form::select('languages', $languages , null , ['class' => 'form-control col-4', 'id' => 'languages', 'style' => 'width: 15%']) !!}
        </div>

        <div class="form-group row ml-2">
            {!! Form::label('languages', trans('common.global_search'), ['class' => 'control-label col-2']) !!}
            {!! Form::text('globalSearch', null, ['class' => 'form-control col-4', 'id' => 'globalSearch']) !!}
        </div>
    </fieldset>

    <table id="stories-table" class="stripe">
        <thead>
            <tr>
                <th></th>   {{-- Child rows button --}}
                <th></th>   {{-- hidden stories IDs --}}
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
        function filterLanguage (table) {
            table.column( 4 ).search(
                $('#languages option:selected').text(),
                false,
                true
            ).draw();
        }

        $(function() {
            function format ( d ) {
                var parser = new DOMParser;
                var dom = parser.parseFromString(d.description, 'text/html');
                var decodedString = dom.body.textContent;

                // Backticks are mandatory here !
                var template = `{!! includeAsJsString('stories.partials.story_details') !!}`;

                var replacements = {
                    "%TEXT%":decodedString,
                    "%PLAY_URL%": route('story.play', {'story': d.id}),
                    "%EDIT_URL%": d.can_edit == true
                        ? '<a href="' + route('story.edit', {'story': d.id}) + '" class="btn btn-success card-link">{{ trans('story.edit') }}</a>'
                        : ' ',
                    "%RESET_STORY%": d.can_reset == true
                        ? '<a href="' + route('story.reset', {'story': d.id}) + '" class="btn btn-danger card-link">{{ trans('story.reset') }}</a>'
                        : ' ',
                };

                return template.replace(/%\w+%/g, function(all) {
                    return replacements[all] || all;
                });
            }

            var table = $('#stories-table').DataTable({
                dom: 'rt<p><"clear">',
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
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'genres', render: function ( data, type, row ) {
                            var genres = [];
                            data.forEach (function (genre) {
                                genres.push(genre.label);
                            });

                            return genres.join(', ');
                        }, 'width': '15%'},
                    {data: 'locale', 'width': '10%'},
                    {data: 'user', 'width': '20%'},
                    {data: 'created_at', 'width': '20%'}
                ],
                "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "visible": false,
                        "searchable": false
                    }
                ]
            });

            $('#languages').on('change', function () {
                filterLanguage(table);
            });

            $('#globalSearch').keyup(function(){
                table.search($(this).val()).draw() ;
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
