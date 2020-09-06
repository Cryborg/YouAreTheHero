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
                showToast('success', {
                    heading: saveSuccessHeading,
                    text: saveSuccessText,
                });

                // Refresh the items list
                if ($('.itemListDiv').length > 0) showItemsList('div');
                if ($('.selectpicker.itemSelectList').length > 0) showItemsList('select');
            })
            .fail(function (data) {
                showToast('error', {
                    heading: saveFailedHeading,
                    text: saveFailedText,
                    errors: data.responseJSON.errors
                });
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

        $('input[name="stat_values[]"]:visible').each(function () {
            values.push({
                'id': $(this).data('id'),
                'operator': $(this).closest('tr').find('.effect_operator option:selected').val(),
                'value': $(this).val()
            });
        });

        ajaxCreatePost(route,  $this, {
            'name': $('#item_name_' + context).val(),
            'default_price': $('#item_price_' + context).val(),
            'is_unique': $('#is_unique_' + context).is(':checked') ? 1 : 0,
            'size': $('#item_size_' + context).val(),
            'effects': values,
            'category': $('#item_category_' + context).val()
        })
    });

    function showItemsList(context) {
        $.get({
            url: route('items.html.list', {'story': storyId, 'context': context}),
        })
            .done(function (html) {
                if (context === 'div') {
                    $('.itemListDiv').html(html);
                } else {
                    $('.dropdown.itemSelectList').html(html);
                    $('.selectpicker').selectpicker();
                }
            });
    }
