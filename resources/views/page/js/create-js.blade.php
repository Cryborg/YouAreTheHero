function newPage($this, url, linkText) {
    let $parent = $this.closest('.modal');
    let text = typeof linkText !== 'undefined'
        ? linkText
        : $parent.find('#link_text').val();
    let hideChoice = $parent.find('#hide_choice').is(':checked') ? 1 : 0;
    let showNewPage = $parent.find('#show_new_page').is(':checked') ? 1 : 0;

    // Create the page and display it
    $.ajax({
        'url': url,
        'data': {
            'page_from': pageId,
            'link_text': text,
            'hidden': hideChoice,
            'showNewPage': showNewPage
        },
        'method': 'POST'
    })
        .done(function (data) {
            if (data.redirect) {
                window.location.href = data.redirect;
            }

            tryDraw(data.graph);

            $('#modalAddChoice').modal('toggle');
        })
        .always(function () {
            $this.html($this.data('original-text'));
            $this.prop('disabled', false);
        });
}

function newEmptyPage(linkText, hideChoice, $select) {
    // Create the page and display it
    $.ajax({
        'url': route('page.create', {'story': storyId}),
        'data': {
            'link_text': linkText,
            'hidden': hideChoice
        },
        'method': 'POST'
    })
        .done(function (data) {
            tryDraw(data.graph);

            // Rajouter la nouvelle page dans la liste déroulante
            if (typeof $select !== undefined) {
                $select.append(new Option(linkText, data.page.id, true, true))
            }
        })
        .always(function () {
            $this.prop('disabled', false);
        });
}

// Transform dates
showHumanReadableDates();

// Refresh the lists
refreshPrerequisitesList();
refreshActionsList();
refreshItemsList();
refreshModalItemsList();

// Draw the graphical tree
tryDraw();

$(document).on('show.bs.modal', '#modalMeta', function (event) {
    var context = $(this).data('context');
    var title;

    switch (context) {
        case 'prerequisite':
            title = '{{ trans('page.prerequisite_modal_title') }}';
            break;
        case 'action':
            title = '{{ trans('page.add_actions_modal_title') }}';
            break;
        case 'item':
            title = '{{ trans('page.item_page_modal_title') }}';
            break;
    }

    $('#modalMetaTitle').html(title);

    if (context === 'item') {
        $('#tr-pre-2-link').hide();
        $('#price_field').show();
    } else {
        $('#tr-pre-2-link').show();
        $('#price_field').hide();
    }
});

$('#title, #is_last, [name="ending_type"]').on('blur', function () {
    savePage();
});


// Saves the page
function savePage() {
    let $this = $(this);

    // Find parent page form
    let $form = $('.divAsForm');

    $('#content-editable:hidden').summernote('destroy');
    $('#content-editable:visible').addClass('hidden');
    $('#content').removeClass('hidden');
    $('.toggle-summernote').addClass('clickable').removeClass('summernote-open');

    let isLast = $('#is_last').is(":checked") ? 1 : 0;
    let data = {
        'title': $('#title').val(),
        'content': $('#content-editable').html(),
        'layout': $('#layout').val(),
        'is_first': $('#is_first').is(":checked") ? 1 : 0,
        'is_last': isLast,
        'ending_type': isLast ? $('[name="ending_type"]:checked').val() : null,
    };

    if ($('#linktext').length > 0) {
        data.link_text = $('#linktext').val();
    }

    $.post({
        url: $form.data('route'),
        data: data
    })
        .done(function (data) {
            tryDraw(data.graph);

            $('#content').html(data.content);
        })
        .fail(function (data) {
            if (data.status === 422) {
                $.each(data.responseJSON.errors, function (i, error) {
                    $form
                        .find('[name="' + i + '"]')
                        .addClass('input-invalid')
                        .next()
                        .append(error[0])
                        .removeClass('hidden');
                });
            }
        })
        .always(function () {
            $this.html($this.data('original-text'));
            $this.prop('disabled', false);
        });
}

function refreshEquipmentLists(itemId)
{
    let data = {};
    itemId = itemId || null;

    if (itemId !== null) {
        data.item_id = itemId;
    }

    $.get({
        url: route('story.equipment', {story: storyId}),
        data: data
    })
        .done(function(html) {
            $('.slotsSelect').html(html.select);

            if (itemId !== null) {
                $('.slotsSelect').find('.equipmentSlot option[value="' + html.equipment_id + '"]').prop('selected', true);
            }
        });
}
