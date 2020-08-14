function loadInventory() {
    $('.inventory-block').html(loadingSpinner);
    $('.inventory-block').load(routeInventory);
}

function loadSheet() {
    $('.sheet-block').html(loadingSpinner);
    $('.sheet-block').load(routeSheet);
}

function loadChoices() {
    let routeChoices = route('page.choices', {'page': $('#pageId').val()});

    $('.choices-block').html(loadingSpinner);
    $('.choices-block').load(routeChoices);
}

function loadContent(route) {
    $('#page_content').html($('#page_content').html());
    $('#page_content').load(route, null, function () {
        loadInventory();
        loadInputSpinner();
    });
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
            loadContent(getContentRoute());
            loadInventory();
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
            // loadContent(getContentRoute());
            loadInventory();
            loadChoices();
            loadSheet();
        })
        .fail(function (result) {
            console.log(result);
        });
});

function getContentRoute() {
    return route('story.play', {'story': $('#storyId').val(), 'page': $('#pageId').val()});
}

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
    pageId = $this.data('page-id');

    if (href !== undefined) {
        loadContent(href);
    }
});

// When the player clicks on an item
$(document).on('click', '.pick-item button', function () {
    var $this = $(this);
    pageId = $('#pageId').val();

    $.get({
        'url': route('item.take', {'page': pageId, 'item': $this.data('itemid')}),
    })
        .done(function (rst) {
            if (rst.result == true) {
                // TODO: refresh this if necessary. Controller should return the info according
                //       to what have been updated
                loadInventory();
                loadSheet();
                loadChoices();

                if (rst.is_unique === true) {
                    $this.closest('.pick-item').remove();
                }
            } else {
                if (rst.message) {
                    showToast('error', {
                        text: rst.message
                    });
                }
            }
        })
        .always(function() {
            $this.html($this.data('original-text'));
            $this.prop('disabled', false);
        });
});


$(function () {
    loadInventory();
    loadSheet();
    loadChoices();
});

$(document).on('click', '#riddle_validate', function () {
    const $this = $(this);

    // Toggle disabled state
    $this.prop('disabled', (i, v) => !v);

    let answer = '';

    // "integer" riddle
    $('.input-spinner:visible').each(function (index) {
        answer += $(this).val();
    });

    if (answer !== '') {
        $('#riddle_answer').val(answer);
    }

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
