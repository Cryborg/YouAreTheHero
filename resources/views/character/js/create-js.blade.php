const storyId = $('#storyId').val();

$(document).on('click touchstart keydown', '#save_character', function () {
    const $this = $(this);
    const characterName = $('#name').val();
    const stats = [];
    const genre = $("[name='character_genre']:checked").val();
    const people = [];

    $('.field-value').each(function () {
        stats.push({
            'field_id': $(this).data('field_id'),
            'value': $(this).html()
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

$(document).on('click touchstart keydown', '.btn-attribute.clickable', function () {
    const $this = $(this);
    const $pointsLeft = $('#points_left');
    const $fieldValue = $this.siblings('.field-value').first();
    const pointsToShare = parseInt($pointsLeft.data('original_value'));

    let actualValue = parseInt($fieldValue.html());
    let pointsLeft = parseInt($pointsLeft.html());

    if ($this.hasClass('btn-decrement')) {
        let minValue = parseInt($this.data('min_value'));

        if (actualValue - 1 >= minValue && pointsLeft + 1 <= pointsToShare) {
            $pointsLeft.html(pointsLeft + 1);
            $fieldValue.html(actualValue - 1);
        }
    }

    if ($this.hasClass('btn-increment')) {
        let maxValue = parseInt($this.data('max_value'));

        if (pointsLeft - 1 >= 0 && actualValue + 1 <= maxValue) {
            $pointsLeft.html(pointsLeft - 1);
            $fieldValue.html(actualValue + 1);
        }
    }

    // Enables/disables save button
    $('#save_character').prop('disabled', (parseInt($pointsLeft.html()) > 0));
});

loadInputSpinner();
