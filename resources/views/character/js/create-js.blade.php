<script type="text/javascript">
    $('.submit-btn').on('click', function () {
        var $this = $(this);
        var characterName = $('#name').val();
        var stats = [];

        $('input[name=stat_value]').each(function () {
            stats.push({
                'name': $(this).data('stat_name'),
                'value': $(this).val()
            });
        });

        if (characterName === '') {
            resetLoader($this);
            $('#name')
                .addClass('input-invalid')
                .next()
                .removeClass('hidden');
            return false;
        }

        $.post({
            url: route('character.create.post', {'story': {{ $story->id }} }),
            data: {
                'name': characterName,
                'stats': stats
            }
        })
        .done(function () {
            window.location.href = '{{ route('story.play', ['story' => $story->id]) }}';
        })
        .fail(function () {

        })
        .always(function () {
            resetLoader($this);
        });
    })
</script>
