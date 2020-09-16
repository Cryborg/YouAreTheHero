function newPage($this, url, linkText) {
    let $parent = $this.closest('.modal');
    let text = typeof linkText !== 'undefined'
        ? linkText
        : $parent.find('#link_text').val();
    let hideChoice = $parent.find('#hide_choice').is(':checked') ? 1 : 0;

    // Create the page and display it
    $.ajax({
        'url': url,
        'data': {
            'page_from': pageId,
            'link_text': text,
            'hidden': hideChoice
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

            showToast('success', {
                heading: saveSuccessHeading,
                text: saveSuccessText,
            });
        })
        .always(function () {
            $this.prop('disabled', false);
        });
}

// help-block state check from cookie
var openToggle = Cookies.get("hero.help-block.show") || false;

if (openToggle === 'true') {
    $("p.help-block").show();
} else {
    $("p.help-block").hide();
}

// Transform dates
showHumanReadableDates();

// Refresh the lists
refreshPrerequisitesList();
refreshActionsList();
refreshItemsList();

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


