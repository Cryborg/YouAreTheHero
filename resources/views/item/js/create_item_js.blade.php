function ajaxCreatePost(urlroute, $this, data)
{
    var commonData = {
        'story_id': storyId
    };

    $.post({
        url: urlroute,
        data: {...data, ...commonData}
    })
        .done(function (data) {
            if (typeof window.refreshModalItemsList === "function") {
                refreshModalItemsList();
            }

            if ($('.itemListDiv').length > 0) {
                $.get({
                    url: route('item.list', {story: storyId})
                })
                    .done(function (html) {
                        $('.itemListDiv').html(html);
                    });
            }
        })
        .always(function () {
            $this.html($this.data('original-text'));
            $this.prop('disabled', false);
        });
}

$(document).on('hide.bs.modal', '#modalPopup', function (event)
{
    $('#modalMeta').modal();
});

$(document).on('click touchstart keydown', '.btnDeleteItem', function () {
    var $this = $(this);
    var id = $this.data('itemid');
    var loadingClass = 'spinner-grow text-danger';
    var defaultClass = $this.attr('class');

    if (!$this.hasClass('fa-spin')) {
        $this.attr('class', loadingClass);
    }

    $.get({
        url: route('item.delete', {item: id}),
        method: 'DELETE'
    })
        .done(function (result) {
            if (result.success && result.type === 'delete') {
                refreshModalItemsList();

                $this.closest('.modal-content').find('.item-details').html('');
            }

            if (result.type === 'confirm') {
                const $modal = $('#modalPopup');

                $modal.find('.modal-header').addClass('modal-header-error');
                $modal.find('.modal-title').html(result.texts.title);
                $modal.find('.modal-body').html(result.html);
                $modal.find('.btn-confirm')
                    .data('itemid', id)
                    .addClass('deleteItemConfirmed')
                    .html(result.texts.button);

                $('#modalMeta').modal('hide');
                $modal.modal();
            }
        })
        .always(function () {
            $this.attr('class', defaultClass);
        });
});

$(document).on('click touchstart keydown', '.itemFieldAdd', function () {
    const $this = $(this);
    const itemId = $this.data('itemid') || null;
    const fieldId = $('.field_id:visible').val();
    const field = {
        operator: $('.field_operator:visible').val(),
        quantity: $('.field_quantity:visible').val(),
    };

    if (fieldId === '') {
        return false;
    }

    if (itemId !== null) {
        // Directly save the item
        const routeItemField = route('item.field.add', {'item': itemId, 'field': fieldId});

        $.get({
            url: routeItemField,
            data: field,
        })
            .done(function () {
                $this.closest('.modal-content').find('.item-details').load(route('item.details', {'item': itemId, 'field': fieldId}));
            });
    } else {
        // The item is not yet created
        const content = '<input type="hidden" name="stat_values[]" data-id="'
                + fieldId + '" value="' + field.quantity + '" data-operator="'
                + field.operator + '">'
            + $('.field_id option:selected').html()
            + ' ' + field.operator
            + ' ' + field.quantity;
        $('.item-fields').append(content);
    }
});

$(document).on('click touchstart keydown', '.deleteItemConfirmed', function () {
    const $this = $(this);
    const itemId = $this.data('itemid');
    const $modal = $('#modalPopup');

    $.get({
        url: route('item.delete', {item: itemId, force: true}),
        method: 'DELETE'
    })
        .done(function(result) {
            if (result.success) {
                refreshModalItemsList();

                $modal.modal('hide');
            }
        });
});

$(document).on('click touchstart keydown', '.btnCreateItem', function () {
    const $this = $(this);
    const context = $this.data('context');
    const route = routeItem;
    var values = [];
    var $parentModal;

    if (context === 'story_creation') {
        $parentModal = $(document);
    } else {
        $parentModal = $this.closest('.modal-content');
    }

    $parentModal.find('input[name="stat_values[]"]').each(function () {
        values.push({
            'id': $(this).data('id'),
            'operator': $(this).data('operator'),
            'value': $(this).val()
        });
    });

    ajaxCreatePost(route,  $this, {
        'id': $parentModal.find('#item_id_' + context).val(),
        'name': $parentModal.find('#item_name_' + context).val(),
        'default_price': $parentModal.find('#item_price_' + context).val(),
        'single_use': $parentModal.find('#single_use_' + context).is(':checked') ? 1 : 0,
        'is_unique': $parentModal.find('#is_unique_' + context).is(':checked') ? 1 : 0,
        'is_throwable': $parentModal.find('#is_throwable_' + context).is(':checked') ? 1 : 0,
        'size': $parentModal.find('#item_size_' + context).val(),
        'effects': values,
        'category': $parentModal.find('#item_category_' + context).val()
    })
});

$(document).on('click touchstart keydown', '.itemSelectList', function () {
    const $this = $(this);
    const itemId = $this.children(":selected").val();

    $.get({
        url: route('item.details', {'item': itemId }),
    })
        .done(function (html) {
            $('.btnCreateItem, .btnDeleteItem').prop('disabled', false);
            $('#modalMeta .btnDeleteItem').data('itemid', itemId);
            $this.closest('.modal-content').find('.item-details').html(html);
        });
});
