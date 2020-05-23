<script>
    $(document).on('show.bs.modal', '#modalAllPages', function (event)
    {
        $('#modalAllPages .modal-body:not(.modal-body-preview)').html('');

        $.get({
            url: route('page.modal.ajax', {story: {{ $data['story']->id }}})
        })
            .done(function (html) {
                $('#modalAllPages .modal-body:not(.modal-body-preview)').html(html);

                showHumanReadableDates();
            });
    });

    $('[data-dismiss="modal-preview"]').on('click', function () {
        $('.modal-body-preview').addClass('hidden');
        $('.modal-preview-content').html('');
    });

    $(document).on('click', '.button-preview', function (event) {
        event.stopImmediatePropagation();

        var $this = $(this);

        $('.modal-body-preview').removeClass('hidden');
        $('.modal-preview-content').html('');

        $(['parents', 'choices']).each(function (id, source) {
            var data = $this.data(source);

            $(data).each(function (id, val) {
                var colWidth = data.length === 1 ? '12' : '6';
                $('#modalAllPages .card[data-pageid="' + val + '"]')
                    .clone()
                    .appendTo('.modal-preview-content')
                    .wrap('<div class="col-lg-' + colWidth + ' col-xs-12"></div>');
            });

            $('.modal-preview-content').wrapInner('<div class="row"></div>');
        });

    });
</script>
