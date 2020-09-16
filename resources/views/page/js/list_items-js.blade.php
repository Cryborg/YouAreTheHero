<script>
    $(document).on('show.bs.modal', '#modalAllItems', function (event)
    {
        // Remove the previous content
        $('#modalAllItems .modal-body').html('');

        $.get({
            url: route('items.modal.list', {story: {{ $data['story']->id }}})
        })
            .done(function (html) {
                $('#modalAllItems .modal-body').html(html);
            });
    });
</script>
