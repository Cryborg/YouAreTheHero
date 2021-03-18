<script type="text/javascript">
    $(document).ready(function () {
        showHumanReadableDates();
    });

    $(document).on('click touchstart keydown', '.deleteStory', function () {
        const $this = $(this);
        let storyId = $this.data('storyid');

        if (confirm("@lang('story.confirm_delete')")) {
            $.ajax({
                url: route('story.delete', {story: storyId}),
                method: 'DELETE'
            })
            .done(function (result) {
                if (result.success) {
                    $this.closest('tr').slideUp();
                }
            });
        }
    });
</script>
