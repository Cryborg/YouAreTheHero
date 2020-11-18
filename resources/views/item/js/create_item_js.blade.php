function ajaxCreatePost(route, $this, data)
{
    var commonData = {
        'story_id': storyId
    };

    $.post({
        url: route,
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

$(document).on('click touchstart keydown', '.btnCreateItem', function () {
    var $this = $(this);
    var route = routeItem;
    var values = [];
    var context = $this.data('context');
    var $parentModal;

    if (context === 'story_creation') {
        $parentModal = $(document);
    } else {
        $parentModal = $this.closest('.modal-content');
    }

    $parentModal.find('input[name="stat_values[]"]:visible').each(function () {
        values.push({
            'id': $(this).data('id'),
            'operator': $(this).closest('tr').find('.effect_operator option:selected').val(),
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
    var $this = $(this);

    $.get({
        url: route('item.details', {'item': $this.children(":selected").val()}),
    })
        .done(function (html) {
            $('.btnCreateItem').prop('disabled', false);
            $this.closest('.modal-content').find('.item-details').html(html);
        });
});
