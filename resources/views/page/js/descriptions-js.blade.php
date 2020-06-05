<script>
    function displayDescriptionsList() {
        $.get({
            url: route('descriptions.show_modal', {page: {{ $page->id }}})
        })
            .done(function (html) {
                $('#modalDescriptions .modal-body').html(html);

                $('.summernote').summernote(summernoteOptionsLight);
            });
    }

    $(document).on('show.bs.modal', '#modalDescriptions', function (event) {
        $('#modalDescriptions .modal-body').html('');
        $('.summernote').summernote(summernoteOptionsLight);

        displayDescriptionsList();
    });

    $(document).on('click', '#save_description', function () {
        var $this = $(this);

        $.post({
            url: route('description.create', {page: {{ $page->id }}}),
            data: {
                'keyword': $('#keyword').val(),
                'description': $('#description').val()
            }
        })
            .done(function () {
                displayDescriptionsList();

                showToast('success', {
                    heading: '{{ trans('notification.save_success_title') }}',
                    text: "{{ trans('notification.save_success_text') }}",
                });
            })
            .fail(function (data) {
                showToast('error', {
                    heading: '{{ trans('notification.save_failed_title') }}',
                    text: "{{ trans('notification.save_failed_text') }}",
                    errors: data.responseJSON.errors
                });
            });
    });

    $(document).on('click', '.editDescription', function () {
        var $this = $(this);
        var id = $this.closest('.card').data('description-id');

        console.log('#description_' + id);
        console.log($('#description').html());
        $('#keyword').val($('#keyword_' + id).html());
        $('#modalDescriptions .summernote').summernote('code', $('#description_' + id).html())
    });

    $(document).on('click', '.deleteDescription', function () {
        var $this = $(this);

        if (!confirm('@lang('description.confirm_delete')')) return false;

        $.ajax({
            url: route('description.delete', {description: $this.closest('.card').data('description-id')}),
            method: 'DELETE'
        })
            .done(function () {
                $this.closest('.card').slideUp(1500, function () {
                    $(this).remove();
                });

                showToast('success', {
                    heading: '{{ trans('notification.deletion_success_title') }}',
                    text: "{{ trans('notification.deletion_success_text') }}",
                });
            })
            .fail(function (data) {
                showToast('error', {
                    heading: '{{ trans('notification.deletion_failed_title') }}',
                    text: "{{ trans('notification.deletion_failed_text') }}",
                    errors: data.responseJSON.errors
                });
            });
    });
</script>
