<script type="text/javascript">
    function newPage($this, route)
    {
        var newNumber = $('a.nav-item.nav-link').length;
        $('a.nav-item.nav-link, div.tab-pane').removeClass('active');

        $('#addNewPage').before(
            '<a class="nav-item nav-link active" href="#p' + newNumber + '" data-toggle="tab">' +
            '<span class="choice_title_' + newNumber + '">' +
            '<input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-' + newNumber + '">' +
            '<div class="alert alert-error hidden"></div>' +
            '</span></span>' +
            '</a>');
        $.ajax({
            'url': route,
            'data': {'internalId': newNumber}
        })
            .done(function (data) {
                $('#choicesForm').append('<div class="tab-pane active" id="p' + newNumber + '">' + data + '</div>');
            })
            .always(function () {
                $this.prop('disabled', false);
            });
    }

    $(document).ready(function () {
        // help-block state check from cookie
        var openToggle = Cookies.get("hero.help-block.show") || false;

        if ( openToggle === 'true') {
            $("p.help-block").show();
        } else {
            $("p.help-block").hide();
        }

        $('.toggle-help').on('click', function() {
            var $pBlocks = $('p.help-block');
            var done = false;

            // Toggle display
            $pBlocks.slideToggle(function () {
                if (!done) {
                    // Update or create the cookie to save state
                    Cookies.set('hero.help-block.show', $pBlocks.eq(0).is(':visible'), {expires: 365});
                    done = true;
                }
            });
        });

        // Create a new tab
        $('#addNewPage').on('click', function(event) {
            event.preventDefault();

            var $this = $(this);
            $this.prop('disabled', true);

            newPage($this, route('page.create', {{ $page->story_id }}));
        });

        $(document).on('click', '.submit-btn', function (e) {
            let $this = $(this).parent('form');
            e.preventDefault();

            // internalId is 0 if the form being submitted is the main page.
            // Otherwise it is > 0
            var internalId = $this.data('internalid');
            var pageLinkTitle = $('#linktext-' + internalId).val();

            var data = $this.serialize();
            if (internalId > 0) data += '&linktitle=' + encodeURIComponent(pageLinkTitle);
            data += '&page_from=' + $('#page_from').val();

            $.ajax({
                method: $this.attr('method'),
                url: $this.attr('action'),
                data: data
            })
                .done(function (data) {
                })
                .fail(function (data) {
                    if(data.status == 422) {
                        $.each(data.responseJSON.errors, function (i, error) {
                            $this
                                .find('[name="' + i + '"]')
                                .addClass('input-invalid')
                                .next()
                                .append(error[0])
                                .removeClass('hidden');
                        });
                    }
                });
        });
    });

    var actionsListDatatable = $('#actions_list').DataTable({
        dom: 'rt<p><"clear">',
        pagingType: 'simple',
        createdRow: function (row, data, index, cells) {
            // Adds a class to the Actions cell
            $(cells[4], row).addClass('text-center');
        },
        drawCallback: function(settings) {
            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
            pagination.toggle(this.api().page.info().pages > 1);
        }
    });

    // When the author chooses an item from the list
    $('#items').on('change', function () {
        var $this = $(this);

        if ($this.val() == '') return false;

        $.ajax({
            url: route('story.ajax_getitem'),
            method: 'POST',
            data: {'itemId': $this.val()}
        })
        .done(function (data) {
            $('#item_description').html(data);
        });
    });

    // When the author creates a child page
    $('.nav-item.nav-link select').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        if ($this.val() == 0) return false;

        $this.prop('disabled', true);

        newPage($this, route('page.create', [{{ $page->story_id }}, $this.val()]));

        $("#childrenSelect option:selected").remove();
    });

    // When the author validates the new action on the modal
    $('#add_action').on('click', function () {
        var serialized = $('#action_create').serialize();
        $.ajax({
            url: '{{ route('actions.store', $page->id) }}',
            'data': serialized,
            'method': 'POST',
        })
        .done(function (data) {
            var result = JSON.parse(data);

            if (result.success) {
                // Show the notification
                showToast('success', {
                    heading: '{{ trans('admin.save_succeeded') }}',
                    text: "{{ trans('actions.new_action_successfully_added') }}",
                });

                // Adds the new action to the table
                actionsListDatatable.row.add([
                    result.action.item.name,
                    result.action.verb,
                    result.action.quantity,
                    result.action.price,
                    '<span class="glyphicon glyphicon-trash" data-action_id="' + result.action.item.id + '"></span>'
                ]).draw();

                // Closes the modal
                $('#modalCreateAction').modal('hide');
            }
        })
        .fail(function (data) {
            if(data.status == 422) {
                $.each(data.responseJSON.errors, function (i, error) {
                    $('#modalCreateAction')
                        .find('[name="' + i + '"]')
                        .addClass('input-invalid')
                        .next()
                        .append(error[0])
                        .removeClass('hidden');
                });
            }
            showToast('error', {
                heading: '{{ trans('admin.error_title') }}',
                text: "{{ trans('actions.new_action_not_added') }}",
            });
        });
    });

    $('.glyphicon-trash').on('click', function () {
        var $this = $(this);
        var actionId = $this.data('action_id');

        $.ajax({
            url: route('actions.delete', actionId),
            method: 'DELETE'
        })
        .done(function () {
            actionsListDatatable
                .row( $this.parents('tr') )
                .remove()
                .draw();
        })
        .fail(function () {
            console.log('fail');
        })
    })
</script>
