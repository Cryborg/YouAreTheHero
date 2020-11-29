$(document).on('click touchstart keydown', '.deleteAction', function () {
    var $this = $(this);
    var actionId = $this.data('actionid');
    var loadingClass = 'spinner-grow text-danger';
    var defaultClass = $this.attr('class');

    if (!$this.hasClass('spinner-grow')) {
        $this.attr('class', loadingClass);
    }

    if (actionId) {
        $.ajax({
            url: route('action.delete', actionId),
            method: 'DELETE'
        })
            .done(function (result) {
                refreshActionsList();
            })
            .fail(function (data) {
                $this.attr('class', defaultClass);
            });
    }
});

$(document).on('click touchstart keydown', '#showPrerequisites', function () {
    const $modal = $('#modalMeta');

    $modal.data('context', 'prerequisite');
    $modal.find("div[data-context-only='prerequisite']").removeClass('hidden');
    $modal.find("div[data-context-only='action']").addClass('hidden');

    $modal.modal();
});

$(document).on('click touchstart keydown', '#showActions', function () {
    const $modal = $('#modalMeta');

    $modal.data('context', 'action');
    $modal.find("div[data-context-only='prerequisite']").addClass('hidden');
    $modal.find("div[data-context-only='action']").removeClass('hidden');

    $modal.modal();
});

$(document).on('click touchstart keydown', '#showItems', function () {
    const $modal = $('#modalMeta');

    $modal.data('context', 'item');
    $modal.find("div[data-context-only='prerequisite']").addClass('hidden');
    $modal.find("div[data-context-only='action']").addClass('hidden');

    $modal.modal();
});

$(document).on('change', '#hideChoice', function () {
    const $this = $(this);
    let choiceId = $this.data('choiceid');

    $.post({
        url: route('choice.update', choiceId),
        data: {
            'hidden': $this.is(':checked') ? 1 : 0
        }
    });
});

$(document).on('click touchstart keydown', "[name='is_last']", function () {
    let $this = $(this);

    $('.ending_types_list').slideToggle();
});


$(document).on('click touchstart keydown', '.deletePrerequisite', function () {
    var $this = $(this);
    var prerequisiteId = $this.data('prerequisite_id');
    var loadingClass = 'spinner-grow text-danger';
    var defaultClass = $this.attr('class');

    if (!$this.hasClass('spinner-grow')) {
        $this.attr('class', loadingClass);
    }

    $.ajax({
        url: route('prerequisite.delete', prerequisiteId),
        method: 'DELETE'
    })
        .done(function () {
            refreshPrerequisitesList();
        })
        .fail(function (data) {
            $this.attr('class', defaultClass);
        });
});


$(document).on('click touchstart keydown', '.deleteItemPage', function () {
    var $this = $(this);
    var itemId = $this.data('itemid');
    var loadingClass = 'spinner-grow text-danger';
    var defaultClass = $this.attr('class');

    if (!$this.hasClass('spinner-grow')) {
        $this.attr('class', loadingClass);
    }

    $.ajax({
        url: route('page.item.delete', {page: pageId, item: itemId}),
        method: 'DELETE'
    })
        .done(function () {
            refreshItemsList();
        })
        .fail(function (data) {
            $this.attr('class', defaultClass);
        });
});

// When tu author creates a new riddle
$(document).on('click touchstart keydown', '#add_CreateRiddle', function () {
    var $this = $(this);

    $.post({
        url: route('riddle.store', {'page': pageId}),
        'data': {
            'answer': $('#riddle_answer_text').val(),
            'type': $('#answer_is_integer').is(':checked') ? 1 : 0,
            'item_id': $('#riddle_item option:selected').val(),
            'target_page_id': $('#riddle_page option:selected').val(),
            'target_page_text': $('#riddle_target_page_text').val(),
        },
    })
        .done(function (data) {
            if (data.success) {
                $('#riddle_table tbody').html('').append(
                    '<tr>' +
                    '<td>' + langPageRiddleAnswerLabel + '</td>' +
                    '<td>' + data.riddle.answer + '</td>' +
                    '</tr>' +
                    (data.riddle.target_page_text != null ?
                        '<tr>' +
                        '<td>' + langPageRiddleTextLabel + '</td>' +
                        '<td>' + data.riddle.target_page_text + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + langPageRiddleTargetPageIdLabel + '</td>' +
                        '<td class="font-italic">' + data.page_title + '</td>' +
                        '</tr>'
                        : '') +
                    '<tr>' +
                    '<td>' + langPageEarnedItemLabel + '</td>' +
                    '<td class="font-italic">' + data.item_name + '</td>' +
                    '</tr>'
                );

                // Closes the modal
                $('#modalCreateRiddle').modal('hide');
            }
        })
        .fail(function (data) {
            if (data.status === 422) {
                $.each(data.responseJSON.errors, function (i, error) {
                    $('#modalCreateRiddle')
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
});

$(document).on('click touchstart keydown', '.choice-text.icon-fountain-pen', function () {
    const $this = $(this);
    const pageFrom = $this.parent().data('page-from');
    const pageTo = $this.parent().data('page-to');

    $this.parent().find('.link-text').attr('id', 'edited_text');

    $.get({
        url: route('page.choice', {pageFrom: pageFrom, pageTo: pageTo})
    })
        .done(function (result) {
            $('#modalEditChoice #edit_link_text').val(result.choice.link_text);
            $('#modalEditChoice #hidden_choice_id').val(result.choice.id);
            $('#modalEditChoice #hide_choice').prop('checked', result.choice.hidden);

            $('#modalEditChoice').modal('show');
        });
});

$(document).on('click touchstart keydown', '#add_Location', function () {
    const $this = $(this);
    const $locationName = $('#location_name');

    $.post({
        url: route('location.store'),
        data: {
            'name': $locationName.val(),
            'page_id': $locationName.data('pageid')
        }
    })
        .done(function (result) {
            if (result.success && result.type !== 'delete') {
                $('.location-label').html(result.location.name);
            }

            $('#modalLocation').modal('hide');
        })
        .always(function () {
            $this.html($this.data('original-text'));
            $this.prop('disabled', false);
        });
});

$(document).on('click touchstart keydown', '.choice-text.icon-trash', function () {
    var $this = $(this);
    var pageFrom = $this.parent().data('page-from');
    var pageTo = $this.parent().data('page-to');

    if (confirm(confirmDeleteLinkText)) {
        $.ajax({
            url: route('page.choice.delete', {'page': pageTo, 'page_from': pageFrom}),
            method: 'DELETE'
        })
            .done(function (data) {
                tryDraw(data.graph);
            });
    }
});

$(document).on('change', '.childrenSelect', function () {
    var $this = $(this);

    $('#show_new_page').attr('checked', $this.val() == 0);
});

// Delete a page from the "story errors list" popup
$(document).on('click touchstart keydown', '.deletePage', function () {
    const $this = $(this);

    if (!confirm(confirmDeletePageText)) return false;

    $.ajax({
        url: route('page.delete', {page: $this.data('pageid')}),
        method: 'DELETE'
    })
        .done(function (result) {
            if (result.success) {
                $this.closest('div.col-12').slideUp(1000, function () {
                    $(this).remove();
                });
            }
        });
});

$(document).on('click touchstart keydown', '#add_AddChoice', function () {
    const $this = $(this);
    const selectedVal = $('.childrenSelect option:selected').val();

    if (selectedVal === '0') {
        newPage($this,
            route('page.create', {'story': storyId})
        );
    } else {
        newPage($this,
            route('page.create', {'story': storyId, 'page': selectedVal})
        );
    }
});

// Display Summernote editor on the clicked div
$(document).on('click touchstart keydown', '.toggle-summernote:not(.summernote-open)', function () {
    let $this = $(this);

    // Destroy all other summernotes so there is only one open at a time
    $('#content-editable:hidden').summernote('destroy');
    $('.toggle-summernote').addClass('clickable').removeClass('summernote-open');

    $this.removeClass('clickable');
    $('#content').addClass('hidden');
    $('#content-editable').removeClass('hidden');
    $('#content-editable:visible').summernote(summernoteOptions);

    $this.addClass('summernote-open');
});

$(document).on('click touchstart keydown', '#add_Meta', function () {
    const $this = $(this);
    const context = $('#modalMeta').data('context');
    let data = {};
    let ajaxRoute;
    let callback;

    switch (context) {
        case 'prerequisite':
            ajaxRoute = route('prerequisite.store', pageId);
            callback = refreshPrerequisitesList;
            break;
        case 'action':
            ajaxRoute = route('action.item.create', pageId);
            callback = refreshActionsList;
            break;
        case 'item':
            ajaxRoute = route('page.item.store', pageId);
            callback = refreshItemsList;
            break;
    }

    // If the "item" tab is selected
    if ($('#tr-pre-1').hasClass('active')) {
        const selectedItem = $('#item_id').val();
        const itemOperator = $('#item_operator option:selected').val();

        if (selectedItem !== null && selectedItem !== '' && typeof selectedItem !== 'undefined') {
            data = {
                'item': selectedItem,
                'quantity': $('#quantity').val(),
                'operator': itemOperator,
                'price': $('#price').val(),
                'type': 'item',
            };
        }
    }

    // If the "stats" tab is selected
    if ($('#tr-pre-2-link').hasClass('active')) {
        const selectedOption = $('#sheet option:selected').val();
        const fieldOperator = $('#field_operator option:selected').val();
        const uniqueAction = $('#unique_action').is(':checked') ? 1 : 0;

        if (selectedOption !== '' && typeof selectedOption !== 'undefined') {
            data = {
                'item': selectedOption,
                'quantity': $('#level').val(),
                'operator': fieldOperator,
                'unique_action': uniqueAction,
                'type': 'field'
            }
        }
    }

    // If the "money" tab is selected
    if ($('#tr-pre-4').hasClass('active')) {
        let currency = $('#currency').val();

        if (currency !== '' && currency > 0) {
            data = {
                'quantity': $('#currency').val(),
                'type': 'currency',
            };
        }
    }

    if (!$.isEmptyObject(data)) {
        if (Object.entries(data).length > 0 && data.constructor === Object) {
            $.post({
                url: ajaxRoute,
                data: data
            })
                .done(function (data) {
                    if (data.success) {
                        callback();
                    }
                })
                .always(function () {
                    $this.html($this.data('original-text'));
                    $this.prop('disabled', false);
                });
        }
    } else {
        $this.html($this.data('original-text'));
        $this.prop('disabled', false);
    }
});

$(document).on('click touchstart keydown', '.createNewPage', function () {
    const text = $('#riddle_target_page_text').val();
    let hideChoice = $('#hide_choice').is(':checked') ? 1 : 0;

    if (text !== '') {
        newEmptyPage(text, hideChoice, $('#riddle_page'));
    } else {
        $('#riddle_target_page_text').css('border-color', 'red');
    }
});

$(document).on('click touchstart keydown', '#modalCreateActions .addActionsField', function ()
{
    var fieldId = $('#modalCreateActions #actions_field_id option:selected').val();

    if (fieldId !== '') {
        $.post({
            url: route('action.field.create', {page: pageId, field: fieldId}),
            data: {
                quantity: $('#modalCreateActions #actions_field_qty').val()
            }
        })
        .done(function (result) {
            refreshActionsList();
        });
    }
});
