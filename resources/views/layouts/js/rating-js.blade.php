<script>
    $(document).on('show.bs.modal', '#modalRating', function (event)
    {
        const storyId = $(event.relatedTarget).data('story');

        // Remove the previous content
        $('#modalRating .modal-body').html('');

        $.get({
            url: route('story.rating.list', {story: storyId})
        })
            .done(function (html) {
                $('#modalRating .modal-body').html(html);

                showHumanReadableDates();
            });
    });
</script>
