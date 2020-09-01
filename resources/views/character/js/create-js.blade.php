$('.submit-btn').on('click', function () {
    var $this = $(this);
    var characterName = $('#name').val();
    var stats = [];

    $('input[name=stat_value]').each(function () {
        stats.push({
            'field_id': $(this).data('field_id'),
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

$(document).on('click touchstart keydown', '.btn-attribute', function () {
    const $pointsLeftDiv = $('#points_left');
    let pointsUsed = 0;

    $('.input-number:hidden').each(function() {
        pointsUsed += parseInt($(this).data('original-value')) - parseInt($(this).val());
    });

    $pointsLeftDiv.html(parseInt($pointsLeftDiv.data('original-value')) + pointsUsed);

    // Enables/disables decrement buttons
    $('.btn-decrement').prop('disabled', parseInt($pointsLeftDiv.html()) <= parseInt($pointsLeftDiv.data('original_value')));

    // Enables/disables increment buttons
    $('.btn-increment').prop('disabled', parseInt($pointsLeftDiv.html()) <= 0);

    // Enables/disables save button
    $('#save_character').prop('disabled', parseInt($pointsLeftDiv.html()) != 0);
});

loadInputSpinner();
