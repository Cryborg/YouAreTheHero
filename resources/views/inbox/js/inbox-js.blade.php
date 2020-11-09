$(document).on('click touchstart keydown', '.thread', function () {
    const $this = $(this);
    const threadId = $this.data('threadid');

    // Hide the actual thread
    $('.one-thread').appendTo($('#cached-threads'));

    if ($('#thread-' + threadId).length > 0) {
        $('#thread-' + threadId).appendTo($('#visible-thread'));
    } else {
        $.get({
            'url': route('inbox.show', {'thread': threadId})
        })
            .done(function (data) {
                $('#visible-thread').html(data.html);
                scrollToLastMessage();
                $('#body:visible').focus();
            });
    }
});

$(document).on('click touchstart keydown', '#sendMessage:not(.disabled)', function () {
    const threadId = $(this).data('threadid');
    const $this = $(this);

    $this.addClass('disabled');

    $.post({
        url: route('inbox.reply', {'thread': threadId}),
        data: {
            'body': $('#body:visible').val()
        }
    })
        .done(function (data) {
            $('#messagesList').append(data.message);
            scrollToLastMessage();
            $('#body:visible').val('').focus();
        })
        .always(function () {
            $this.removeClass('disabled');
        })
    ;
});

// Ctrl+Enter sends the message
$(document).on('keyup', '#body:visible', function (e) {
    if (e.ctrlKey && e.keyCode === 13 && !$('#sendMessage').is(':disabled')) {
        $('#sendMessage').trigger('click');
    }
});

function scrollToLastMessage()
{
    $('#messagesList').animate({ scrollTop: $('#messagesList').prop("scrollHeight")}, 500);
}

$(document).on('click touchstart keydown', '#add_AddMessage', function () {
    $.post({
        url: route('inbox.store'),
        data: {
            'body': $('#body:visible').val(),
            'recipients': $('#recipients').val(),
        }
    })
});
