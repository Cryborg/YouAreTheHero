<script type="text/javascript">
    $(document).ready(function () {
        showHumanReadableDates();
    });

    $(document).on('click touchstart keydown', '.deleteStory', function () {
        var $this = $(this);
        var storyId = $this.data('storyid');

        if (confirm("@lang('story.confirm_delete')")) {
            $.ajax({
                url: route('story.delete', {story: storyId}),
                method: 'DELETE'
            })
            .done(function (result) {
                if (result.success) {
                    $this.closest('tr').slideUp();

                    showToast('success', {
                        heading: "{{ trans('notification.deletion_success_title') }}",
                        text: "{{ trans('notification.deletion_success_text') }}",
                    });
                }
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
</script>
