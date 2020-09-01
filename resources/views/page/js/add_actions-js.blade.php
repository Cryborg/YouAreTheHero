<script>
    $(document).on('click touchstart keydown', '#modalCreateActions .addActionsField', function ()
    {
        var fieldId = $('#modalCreateActions #actions_field_id option:selected').val();

        if (fieldId !== '') {
            $.post({
                url: route('action.field.create', {page: {{ $page->id }}, field: fieldId}),
                data: {
                    quantity: $('#modalCreateActions #actions_field_qty').val()
                }
            })
                .done(function (result) {
                    refreshActionsList();

                    showToast('success', {
                        heading: "{{ trans('notification.save_success_title') }}",
                        text: "{{ trans('notification.save_success_text') }}",
                    });
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: "{{ trans('notification.deletion_failed_title') }}",
                        text: "{{ trans('notification.deletion_failed_text') }}",
                        errors: data.responseJSON.errors
                    });
                });
        }
    });

    $(document).on('click touchstart keydown', '#modalCreateActions .addActionsItem', function ()
    {
        var itemId = $('#modalCreateActions #add_actions_item_id option:selected').val();

        if (itemId !== '') {
            $.post({
                url: route('action.item.create', {page: {{ $page->id }}, item: itemId}),
                data: {
                    quantity: $('#modalCreateActions #actions_item_qty').val()
                }
            })
                .done(function (result) {
                    refreshActionsList();

                    showToast('success', {
                        heading: "{{ trans('notification.save_success_title') }}",
                        text: "{{ trans('notification.save_success_text') }}",
                    });
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: "{{ trans('notification.deletion_failed_title') }}",
                        text: "{{ trans('notification.deletion_failed_text') }}",
                        errors: data.responseJSON.errors
                    });
                });
        }
    });

    $(document).on('click touchstart keydown', '.deleteAction', function () {
        var $this = $(this);
        var actionId = $this.data('actionid');

        if (actionId) {
            $.ajax({
                url: route('action.delete', actionId),
                method: 'DELETE'
            })
                .done(function (result) {
                    // Remove the line from all the tables. Saves one ajax call.
                    $('[data-actionid="' + actionId + '"]').closest('tr').remove();

                    showToast('success', {
                        heading: "{{ trans('notification.save_success_title') }}",
                        text: "{{ trans('notification.save_success_text') }}",
                    });
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: "{{ trans('notification.deletion_failed_title') }}",
                        text: "{{ trans('notification.deletion_failed_text') }}",
                        errors: data.responseJSON.errors
                    });
                });
        }
    });

    function refreshActionsList() {
        $.get({
            url: route('action.listjs', {page: {{ $page->id }} })
        })
        .done(function (result) {
            $('.actionsTable tbody').html('')

            $(result.actions).each(function (id, elt) {
                $('.actionsTable tbody').append('<tr>' +
                    '<td>' + (elt.actionable_type === 'item' ? '@lang('actions.item')' : '@lang('actions.field')') + '</td>' +
                    '<td>' + elt.actionable.name + '</td>' +
                    '<td>' + elt.quantity + '</td>' +
                    '<td><span class="icon-trash text-red clickable deleteAction" data-actionid="' + elt.id + '"></span></td>');
            });
        })
        .fail(function () {

        });
    }

    refreshActionsList();
</script>
