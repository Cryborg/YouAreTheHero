function loadPurse() {
    var $block = $('.purse-block');
    $block.html(loadingSpinner);
    $block.load(routePurse);
}

function loadInventory() {
    var $block = $('.inventory-block');
    $block.html(loadingSpinner);
    $block.load(routeInventory);
}

function loadSheet() {
    var $block = $('.sheet-block');
    $block.html(loadingSpinner);
    $block.load(routeSheet);
}

function loadChoices() {
    var $block = $('.choices-block');
    let routeChoices = route('page.choices', {'page': $('#pageId').val()});

    $block.html(loadingSpinner);
    $block.load(routeChoices);
}

function loadContent(route) {
    // $('#page_content').html($('#page_content').html());
    $('#page_content').load(route, null, function () {
        loadInputSpinner();
        refreshData();
    });
}

$(document).on('click touchstart keydown', '.itemThrowAway', function () {
    var itemId = $(this).data('characteritemid');

    $.get({
        url: route('item.throw_away', {'character_item': itemId})
    })
        .done(function (result) {
            loadContent(getContentRoute());
        })
        .fail(function (result) {
            console.log(result);
        });
});

$(document).on('click touchstart keydown', '.itemUse', function () {
    var itemId = $(this).data('itemid');
    var characterId = $(this).data('characterid');

    $.get({
        url: route('item.use', {'character': characterId, 'item': itemId})
    })
        .done(function (result) {
            refreshData();
        })
        .fail(function (result) {
            console.log(result);
        });
});

function getContentRoute() {
    return route('story.play', {'story': $('#storyId').val(), 'page': $('#pageId').val()});
}

$('html').on('click touchstart keydown', function () {
    $('.popup-menu').hide();
});


$(document).on('click touchstart keydown', '#add_PageReport', function () {
    var $this = $(this);
    var type = $('#modalPageReport #report_error_type option:selected').val();
    var comment = $('#modalPageReport #report_comment').val();

    $.post({
        url: route('report.store', {page: pageId}),
        data: {
            'error_type': type,
            'comment': comment
        }
    });
});

// Ajax links
$(document).on('click touchstart keydown', 'a', function () {
    var $this = $(this);
    var href = $this.data('href');

    if (href !== undefined) {
        loadContent(href);
    }
});

// When the player clicks on an item
$(document).on('click touchstart keydown', '.pick-item button', function () {
    const $this = $(this);

    $.get({
        'url': route('item.take', {'page': $('#pageId').val(), 'item': $this.data('itemid')}),
    })
        .done(function (rst) {
            if (rst.success == true) {
                // TODO: refresh this if necessary. Controller should return the info according
                //       to what have been updated
                //refreshData();

                if (rst.is_unique === true) {
                    $this.closest('.pick-item').remove();
                }
            }
        })
        .always(function() {
            $this.html($this.data('original-text'));
            $this.prop('disabled', false);
        });
});

$(document).on('click touchstart keydown', '#riddle_validate', function () {
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
        url: route('page.riddle.validate', {'page': $('#pageId').val()}),
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

function refreshData()
{
    loadInventory();
    loadSheet();
    loadChoices();
}

$(function () {
    refreshData();
});
