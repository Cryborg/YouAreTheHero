<script>
    $(document).on('click touchstart keydown', '#add_EditChoice', function ()
    {
        const $this = $(this);

        let choiceId = $('#modalEditChoice #hidden_choice_id').val();
        let choiceText = $('#modalEditChoice #edit_link_text').val();
        let hideChoice = $('#modalEditChoice #hide_choice').is(':checked') ? 1 : 0;

        if (choiceId !== '') {
            $.post({
                url: route('choice.update', choiceId),
                data: {
                    'link_text': choiceText,
                    'hidden': hideChoice,
                }
            })
                .done(function (result) {
                    $('#edited_text').html(choiceText).attr('id', '');
                })
                .always(function () {
                    $this.html($this.data('original-text'));
                    $this.prop('disabled', false);
                });
        }
    });
</script>
