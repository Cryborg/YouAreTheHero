$(document).on('click touchstart keydown', '.thread', function () {
    const $this = $(this);
    const threadId = $this.data('threadid');
    const $visibleThread = $('#visible-thread');

    // Hide the actual thread
    $('.one-thread').appendTo($('#cached-threads'));

    if ($('#thread-' + threadId).length > 0) {
        $('#thread-' + threadId).appendTo($('#visible-thread'));

        scrollToLastMessage();

        $visibleThread.find('#body').focus();
    } else {
        $.get({
            'url': route('inbox.show', {'thread': threadId})
        })
            .done(function (data) {
                $('#visible-thread').html(data.html);

                scrollToLastMessage();

                $visibleThread.find('#body').focus();
            });
    }
});

$(document).on('click touchstart keydown', '#sendMessage:not(.disabled)', function () {
    const threadId = $(this).data('threadid');
    const $this = $(this);
    const $visibleThread = $('#visible-thread');

    $this.addClass('disabled');

    $.post({
        url: route('inbox.reply', {'thread': threadId}),
        data: {
            'body': $visibleThread.find('#body').val()
        }
    })
        .done(function (data) {
            $visibleThread.find('#messagesList').append(data.message);
            scrollToLastMessage();
            $visibleThread.find('#body').val('').focus();
        })
        .always(function () {
            $this.removeClass('disabled');
        })
    ;
});

// Ctrl+Enter sends the message
$(document).on('keyup', '#body:visible', function (e) {
    if (e.ctrlKey && e.keyCode === 13 && !$('#sendMessage').is(':disabled')) {
        $('#visible-thread').find('#sendMessage').trigger('click');
    }
});

function scrollToLastMessage()
{
    const $visibleThread = $('#visible-thread');

    $visibleThread.find('#messagesList').animate({ scrollTop: $visibleThread.find('#messagesList').prop("scrollHeight")}, 500);
}

$(document).on('click touchstart keydown', '#add_AddMessage', function () {
    const $modal = $('#modalAddMessage');

    $.post({
        url: route('inbox.store'),
        data: {
            'body': $modal.find('#body').val(),
            'recipients': $modal.find('#recipients').val(),
        }
    })
        .done(function (data) {
            if (data.isNew === true) {
                $('.threads-list').prepend(data.html);
            }
        });
});
