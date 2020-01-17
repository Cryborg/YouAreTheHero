<script type="text/javascript">
    $('.submit-btn').on('click', function () {
        var $this = $(this);
        var characterName = $('#name').val();
        var stats = [];

        $('input[name=stat_value]').each(function () {
            stats.push({
                'stat_id': $(this).data('stat_id'),
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
        .done(function (result) {
            if (result.success) {
                window.location.href = '{{ route('story.play', ['story' => $story->id]) }}';
            }
        })
        .fail(function () {

        })
        .always(function () {
            resetLoader($this);
        });
    });

    function addPoints(amount) {
        var points = parseInt($('#points_left').html());
        var newPoints = points + amount;
        $('#points_left').html(newPoints);

        $('#save_story').attr('disabled', newPoints > 0);
    }
</script>
