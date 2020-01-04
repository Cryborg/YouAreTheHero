<script type="text/javascript">
    $('.submit-btn').on('click', function () {
        var $this = $(this);
        var characterName = $('#name').val();

        if (characterName === '') {
            resetLoader($this);
            return;
        }

        $.post({
            url: route('character.create.post', {'story': {{ $story->id }} }),
            data: {'name': characterName}
        })
        .done(function () {
            window.location.href = '{{ route('story.play', ['story' => $story->id]) }}';
        })
        .fail(function () {

        })
        .always(function () {

        });
    })
</script>
