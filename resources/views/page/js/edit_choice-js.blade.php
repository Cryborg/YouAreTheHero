<script>
    $(document).on('click touchstart keydown', '#add_EditChoice', function ()
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
                    $('#edited_text').html(choiceText).attr('id', '');
                });
        }
    });
</script>
