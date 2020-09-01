<script>
    $(document).on('show.bs.modal', '#modalAllPages', function (event)
    {
        // Remove the previous content
        $('#modalAllPages .modal-body:not(.modal-body-preview)').html('');

        $.get({
            url: route('page.list', {story: {{ $data['story']->id }}})
        })
            .done(function (html) {
                $('#modalAllPages .modal-body:not(.modal-body-preview)').html(html);

                showHumanReadableDates();
            });
    });

    $('[data-dismiss="modal-preview"]').on('click touchstart keydown', function () {
        $('.modal-body-preview').addClass('hidden');
        $('.modal-preview-content').html('');
    });

    $(document).on('click touchstart keydown', '.button-preview', function (event) {
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
