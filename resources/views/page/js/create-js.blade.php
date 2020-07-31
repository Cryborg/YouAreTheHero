
    $(document).on('click', '#add_AddChoice', function () {
        var $this = $(this);
        var selectedVal = $('.childrenSelect option:selected').val();

        if (selectedVal === '0') {
            newPage($this,
                route('page.create', {'story':storyId })
            );
        } else {
            newPage($this,
                route('page.create', {'story': storyId, 'page': selectedVal})
            );
        }
    });

    function newPage($this, url, linkText) {
        let $parent = $this.closest('.modal');
        let text = typeof linkText !== 'undefined'
            ? linkText
            : $parent.find('#link_text').val();

        // Create the page and display it
        $.ajax({
            'url': url,
            'data': {
                'page_from': pageId,
                'link_text': text
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

    function newEmptyPage(linkText, $select) {
        // Create the page and display it
        $.ajax({
            'url': route('page.create', {'story': storyId}),
            'data': {
                'link_text': linkText
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

    $(document).ready(function ()
    {
        $(document).on('change', '.childrenSelect', function () {
            var $this = $(this);

            $('#show_new_page').attr('checked', $this.val() == 0);
        });

        // Delete a page from the "list all pages" popup
        $(document).on('click', '.deletePage', function ()
        {
            var $this = $(this);

            if (!confirm(confirmDeleteText)) return false;

            $.ajax({
                url: route('page.delete', {page: $this.data('pageid')}),
                method: 'DELETE'
            })
                .done(function (result) {
                    if (result.success) {
                        $this.closest('div.col-12').slideUp(1000, function () {
                            $(this).remove();
                        });

                        showToast('success', {
                            heading: deletionSuccessTitle,
                            text: deletionSuccessText,
                        });
                    }
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: deletionSuccessText,
                        text: deletionFailedText,
                        errors: data.responseJSON.errors
                    });
                });
        });

        // help-block state check from cookie
        var openToggle = Cookies.get("hero.help-block.show") || false;

        if (openToggle === 'true') {
            $("p.help-block").show();
        } else {
            $("p.help-block").hide();
        }

        $(document).on('click', '.toggle-help', function () {
            var $pBlocks = $('p.help-block');
            var done = false;

            // Toggle display
            $pBlocks.slideToggle(function () {
                if (!done) {
                    // Update or create the cookie to save state
                    Cookies.set('hero.help-block.show', $pBlocks.eq(0).is(':visible'), {expires: 365});
                    done = true;
                }
            });
        });

        // Display Summernote editor on the clicked div
        $(document).on('click', '.toggle-summernote:not(.summernote-open)', function () {
            let $this = $(this);

            // Destroy all other summernotes so there is only one open at a time
            $("[id^='content-editable-']:hidden").summernote('destroy');
            $('.toggle-summernote').addClass('clickable').removeClass('summernote-open');

            $this.removeClass('clickable');
            $('#content-' + pageId).addClass('hidden');
            $('#content-editable-' + pageId).removeClass('hidden');
            $('#content-editable-' + pageId + ':visible').summernote(summernoteOptions);

            $this.addClass('summernote-open');
        });

        // Saves the page
        $(document).on('click', '.savePage', function (e) {
            let $this = $(this);
            let currentPageId = pageId;

            // Find parent page form
            let $form = $('.divAsForm');

            $('#content-editable-' + currentPageId + ':hidden').summernote('destroy');
            $('#content-editable-' + currentPageId + ':visible').addClass('hidden');
            $('#content-' + currentPageId).removeClass('hidden');
            $('.toggle-summernote').addClass('clickable').removeClass('summernote-open');

            var data = {
                'title': $('#title-' + currentPageId).val(),
                'content': $('#content-editable-' + currentPageId).html(),
                'layout': $('#layout-' + currentPageId).val(),
                'is_first': $('#is_first-' + currentPageId).is(":checked") ? 1 : 0,
                'is_last': $('#is_last-' + currentPageId).is(":checked") ? 1 : 0,
                'is_checkpoint': $('#is_checkpoint-' + currentPageId).is(":checked") ? 1 : 0,
            };

            if ($('#linktext-' + currentPageId).length > 0) {
                data.link_text = $('#linktext-' + currentPageId).val();
            }

            $.post({
                url: $form.data('route'),
                data: data
            })
                .done(function (data) {
                    tryDraw(data.graph);

                    $('#content-' + currentPageId).html(data.content);
                    showToast('success', {
                        heading: saveSuccessHeading,
                        text: saveSuccessText,
                    });
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

                    showToast('error', {
                        heading: deletionSuccessText,
                        text: deletionFailedText,
                        errors: data.responseJSON.errors
                    });

                })
                .always(function () {
                    $this.html($this.data('original-text'));
                    $this.prop('disabled', false);
                });
        });

        $(document).on('click', '#add_CreatePrerequisite', function () {
            var $this = $(this);
            let $parent = $this.closest('.modal');
            var data = {};

            // If the "item" tab is selected
            if ($('#tr-pre-1').hasClass('active')) {
                data = {
                    'items': $('#prerequisite_item_id').val(),
                    'quantity': $('#prerequisite_quantity').val()
                };
            }

            // If the "stats" tab is selected
            if ($('#tr-pre-2').hasClass('active')) {
                if ($('#sheet option:selected').val() !== '') {
                    var key = $('#sheet option:selected').text();
                    var value = $('#level').val();

                    data['stats'] = {};
                    data['stats'][key] = value;
                }
            }

            // If the "money" tab is selected
            if ($('#tr-pre-3').hasClass('active')) {
                let money = $('#prerequisite_money').val();

                if (money !== '' && money > 0) {
                    data['money'] = money;
                }
            }

            if (Object.entries(data).length > 0 && data.constructor === Object) {
                $.post({
                    url: route('prerequisite.store', pageId),
                    data: data
                })
                    .done(function (data) {
                        if (data.success) {
                            var items = data.prerequisites.items;

                            items.forEach(function (item) {
                                // Adds the new action to the table
                                $('#prerequisites_list-' + pageId + ' tbody').append(
                                    '<tr>' +
                                    '<td>' + langItem + '</td>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td class="text-center">' + '<span class="icon-trash text-danger delete-prerequisite" data-prerequisite_id="' + item.prerequisite_id + '"></span></td>' +
                                    '</tr>'
                                );
                            });

                            showToast('success', {
                                heading: saveSuccessHeading,
                                text: saveSuccessText,
                            });

                            $('#modalCreatePrerequisite').modal('hide');
                        }
                    })
                    .fail(function (data) {
                        showToast('error', {
                            heading: deletionSuccessText,
                            text: deletionFailedText,
                            errors: data.responseJSON.errors
                        });
                    })
                    .always(function () {
                        $this.html($this.data('original-text'));
                        $this.prop('disabled', false);
                    });
            }
        });

        $(document).on('click', '.createNewPage', function () {
            var $this = $(this);
            var text = $('#riddle_target_page_text').val();

            if (text !== '') {
                newEmptyPage(text, $('#riddle_page'));
            } else {
                $('#riddle_target_page_text').css('border-color', 'red');
            }
        });

        showHumanReadableDates();
        tryDraw();
    });

    $(document).on('click', '.choice-text.icon-fountain-pen', function () {
        var $this = $(this);
        var pageFrom = $this.parent().data('page-from');
        var pageTo = $this.parent().data('page-to');

        $this.parent().find('.link-text').attr('id', 'edited_text');

        $.get({
            url: route('page.choice', {pageFrom: pageFrom, pageTo: pageTo})
        })
            .done(function (result) {
                $('#modalEditChoice #link_text').val(result.choice.link_text);
                $('#modalEditChoice #hidden_choice_id').val(result.choice.id);

                $('#modalEditChoice').modal('show');
            });
    });

    $(document).on('click', '.choice-text.icon-trash', function () {
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

                    showToast('success', {
                        heading: deletionSuccessTitle,
                        text: deletionSuccessText,
                    });
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: deletionFailedTitle,
                        text: deletionFailedText,
                        errors: data.responseJSON.errors
                    });
                });
        }
    });

    // When the author validates the new action on the modal
    $(document).on('click', '#add_CreateItemPage', function () {
        var $this = $(this);
        var serialized = $('#action_create').serialize();

        $.post({
            url: route('page.item.store', pageId),
            data: serialized
        })
            .done(function (data) {
                if (data.success) {
                    // Show the notification
                    showToast('success', {
                        heading: saveSuccessHeading,
                        text: saveSuccessText,
                    });

                    // Refresh the actions table
                    displayActions();
                }
            })
            .fail(function (data) {
                showToast('error', {
                    heading: deletionSuccessText,
                    text: "{{ trans('notification.new_action_not_added') }}",
                    errors: data.responseJSON.errors
                });
            })
            .always(function () {
                $this.html($this.data('original-text'));
                $this.prop('disabled', false);
            });
    });

    function displayActions()
    {
        $.get({
            url: route('page.items.list', {page: pageId })
        })
            .done(function (html) {
                $('.itemsOnPage').html(html);
            });
    }

    // When tu author creates a new riddle
    $(document).on('click', '#add_CreateRiddle', function () {
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
                    // Show the notification
                    showToast('success', {
                        heading: saveSuccessHeading,
                        text: saveSuccessText,
                    });

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
                    $('#modalCreateItemPage').modal('hide');
                }
            })
            .fail(function (data) {
                if (data.status === 422) {
                    $.each(data.responseJSON.errors, function (i, error) {
                        $('#modalCreateItemPage')
                            .find('[name="' + i + '"]')
                            .addClass('input-invalid')
                            .next()
                            .append(error[0])
                            .removeClass('hidden');
                    });
                }
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
    });

    $(document).on('click', '.deleteItemPage', function () {
        var $this = $(this);
        var itemId = $this.data('itemid');
        var loadingClass = 'fa fa-circle-o-notch fa-spin';
        var defaultClass = 'icon-trash text-danger';

        if (!$this.hasClass('fa-spin')) {
            $this.attr('class', loadingClass);
        }

        $.ajax({
            url: route('page.item.delete', {page: pageId, item: itemId}),
            method: 'DELETE'
        })
            .done(function () {
                displayActions();

                showToast('success', {
                    heading: deletionSuccessTitle,
                    text: deletionSuccessText,
                });
            })
            .fail(function (data) {
                showToast('error', {
                    heading: deletionFailedTitle,
                    text: deletionFailedText,
                    errors: data.responseJSON.errors
                });
            })
            .always(function () {
                $this.attr('class', defaultClass);
            });
    });

    $(document).on('click', '.delete-prerequisite', function () {
        var $this = $(this);
        var prerequisiteId = $this.data('prerequisite_id');
        var loadingClass = 'fa fa-circle-o-notch fa-spin';
        var defaultClass = 'icon-trash text-danger';

        if (!$this.hasClass('fa-spin')) {
            $this.attr('class', loadingClass);
        }

        $.ajax({
            url: route('prerequisite.delete', prerequisiteId),
            method: 'DELETE'
        })
            .done(function () {
                $this.parents('tr').remove();

                showToast('success', {
                    heading: deletionSuccessTitle,
                    text: deletionSuccessText,
                });
            })
            .fail(function (data) {
                showToast('error', {
                    heading: deletionFailedTitle,
                    text: deletionFailedText,
                    errors: data.responseJSON.errors
                });
            })
            .always(function () {
                $this.attr('class', defaultClass);
            });
    });

    $(document).on('click', '.show-help', function () {
        $this = $(this);
        $('#' + $this.data('help')).slideToggle();
    });
