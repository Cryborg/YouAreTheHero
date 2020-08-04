<script>
    $(document).on('click', '#add_EditChoice', function ()
    {
        var choiceId = $('#modalEditChoice #hidden_choice_id').val();
        var choiceText = $('#modalEditChoice #edit_link_text').val();

        if (choiceId !== '') {
            $.post({
                url: route('choice.update', choiceId),
                data: {
                    'link_text': choiceText
                }
            })
                .done(function (result) {
                    showToast('success', {
                        heading: "{{ trans('notification.save_success_title') }}",
                        text: "{{ trans('notification.save_success_text') }}",
                    });

                    $('#edited_text').html(choiceText).attr('id', '');
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
