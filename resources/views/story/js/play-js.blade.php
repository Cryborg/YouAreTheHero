function loadInventory() {
    $('.inventory-block').load(routeInventory);
}

function loadSheet() {
    $('.sheet-block').load(routeSheet);
}

function loadChoices() {
    $('.choices-block').load(routeChoices);
}

function loadContent(route) {
    $('#page_content').load(route);
}

$(document).on('click', '.itemThrowAwayMenu', function () {
    var $this = $(this);
    var popupId = $this.data('id');
    $('[data-popupid="' + popupId + '"').show();
});

$(document).on('click', '.itemThrowAway', function () {
    var itemId = $(this).closest('a.itemThrowAwayMenu').data('itemid');

    $.get({
        url: route('item.throw_away', {'item': itemId})
    })
        .done(function (result) {
            loadContent(routeContent);
        })
        .fail(function (result) {
            console.log(result);
        });
});

$(document).on('click', '.itemUse', function () {
    var itemId = $(this).closest('a.itemThrowAwayMenu').data('itemid');

    $.get({
        url: route('item.use', {'item': itemId})
    })
        .done(function (result) {
            loadContent(routeContent);
        })
        .fail(function (result) {
            console.log(result);
        });
});

$('html').on('click', function () {
    $('.popup-menu').hide();
});


$(document).on('click', '#add_PageReport', function () {
    var $this = $(this);
    var type = $('#modalPageReport #report_error_type option:selected').val();
    var comment = $('#modalPageReport #report_comment').val();

    $.post({
        url: route('report.store', {page: pageId}),
        data: {
            'error_type': type,
            'comment': comment
        }
    })
        .done(function (data) {
            if (data.success) {
                showToast('success', {
                    heading: saveSuccessHeading,
                    text: saveSuccessText,
                });
            } else {
                showToast('error', {
                    heading: saveFailedHeading,
                    text: saveFailedText,
                });
            }
        })
        .fail(function (data) {
            showToast('error', {
                heading: saveFailedHeading,
                text: saveFailedText,
            });
        });
});

// Ajax links
$(document).on('click', 'a', function () {
    var $this = $(this);
    var href = $this.data('href');

    if (href !== undefined) {
        loadContent(href);
    }
});

// When the player clicks on an item
$(document).on('click', '.pick-item button', function () {
    var $this = $(this);

    $.get({
        'url': route('item.take', {'page': pageId, 'item': $this.data('itemid')}),
    })
        .done(function (rst) {
            if (rst.result == true) {
                loadInventory();
                loadSheet();
                loadChoices();

                if (rst.singleuse === true) {
                    $this.closest('.pick-item').remove();
                }
            } else {
                if (rst.message) {
                    showToast('error', {
                        text: rst.message
                    });
                }
            }
        });
});


$(function () {
    loadInventory();
    loadSheet();
    loadChoices();
});

$(document).on('click', '#riddle_validate', function () {
    $this = $(this);

    // Toggle disabled state
    $this.prop('disabled', (i, v) => !v);

    $.post({
        url: route('page.riddle.validate', {'page': pageId}),
        data: {
            'answer': $('#riddle_answer').val()
        }
    })
        .done(function (data) {
            if (data.success) {
                if (data.itemResponse) {
                    $('.riddle-block').html(data.itemResponse);
                }

                if (data.pageResponse) {
                    $('.btn-toolbar').append(data.pageResponse);
                }

                $('.riddle_text').remove();
            } else {
                $this.closest('.card').addClass('border-danger');
            }
        })
        .fail(function (data) {
            $this.closest('.card').addClass('border-danger');
        })
        .always(function () {
            // Toggle disabled state
            $this.prop('disabled', (i, v) => !v);

            setTimeout(function () {
                $this.closest('.card').removeClass('border-danger');
            }, 3000);
        });
});
