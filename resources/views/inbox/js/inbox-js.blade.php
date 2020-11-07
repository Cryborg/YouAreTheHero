$(document).on('click', '.thread', function () {
    const $this = $(this);
    const threadId = $this.data('threadid');

    $.get({
        'url': route('inbox.show', {'thread': threadId})
    })
        .done(function (data) {
            $('#messages').html(data.html);
            scrollToLastMessage();
        })
});

$(document).on('click', '#sendMessage', function () {
    const threadId = $(this).data('threadid');

    $.post({
        url: route('inbox.reply', {'thread': threadId}),
        data: {
            'body': $('#body').val()
        }
    })
        .done(function (data) {
            $('#messagesList').append(data.message);
            scrollToLastMessage();
            $('#body').val('').focus();
        });
});

function scrollToLastMessage()
{
    $('#messagesList').animate({ scrollTop: $('#messagesList').prop("scrollHeight")}, 500);
}
