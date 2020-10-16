const storyId = $('#storyId').val();

$('.submit-btn').on('click touchstart keydown', function () {
    const $this = $(this);
    const characterName = $('#name').val();
    const stats = [];
    const genre = $("[name='character_genre']:checked").val();
    const people = [];

    $('input[name=stat_value]').each(function () {
        stats.push({
            'field_id': $(this).data('field_id'),
            'value': $(this).val()
        });
    });

    $('.row_person').each(function () {
        const $this = $(this);

        people.push({
            'id': $this.data('personid'),
            'first_name': $this.find('.first_name').val(),
            'last_name': $this.find('.last_name').val(),
        })
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
        url: route('character.create.post', {'story': storyId }),
        data: {
            'name': characterName,
            'stats': stats,
            'genre': genre,
            'people': people
        }
    })
    .done(function (result) {
        if (result.success) {
            window.location.href = route('story.play', {'story': storyId });
        }
    })
    .fail(function () {
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
