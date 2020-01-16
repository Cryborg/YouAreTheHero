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
                "%PLAY_URL%": '<a href="' + route('story.play', {'story': d.id}) + '" class="btn btn-primary card-link w-100 mb-1">{{ trans('story.start_playing') }}</a>',
                "%EDIT_URL%": d.can_edit == true
                    ? '<a href="' + route('story.edit', {'story': d.id}) + '" class="btn btn-success card-link w-100 mb-1">{{ trans('story.edit') }}</a>'
                    : ' ',
                "%RESET_STORY%": d.can_reset == true
                    ? '<a href="' + route('story.reset', {'story': d.id}) + '" class="btn btn-danger card-link w-100 mb-1">{{ trans('story.reset') }}</a>'
                    : ' ',
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
            responsive: {
                details: false
            },
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
                {data: 'updated_at', "render": function (data, type, row) {
                        return moment(data).fromNow();
                    }, 'width': '20%'},
                {data: 'description'},
            ],
            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 7 ],
                    "visible": false
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
