<script type="text/javascript">
    @include('page.js.dagred3-js', ['pages' => $page->story->pages, 'current' => $page])

    $(document).on('click', '#add_AddChoice', function () {
        var $this = $(this);
        var selectedVal = $('.childrenSelect option:selected').val();

        if (selectedVal === '0') {
            newPage($this,
                route('page.create', {{ $page->story_id }})
            );
        } else {
            newPage($this,
                route('page.create', {'story': {{ $page->story_id }}, 'page': selectedVal})
            );
        }

    });

    function newPage($this, route) {
        let $parent = $this.closest('.modal');

        // Create the page and display it
        $.ajax({
            'url': route,
            'data': {
                'page_from': {{ $page->id }},
                'link_text': $parent.find('#link_text').val()
            },
            'method': 'POST'
        })
            .done(function (data) {
                // Show the link on the tree
                g.setEdge({{ $page->id }}, data.page_to);
                render(svg.select("g"), g);

                $('#modalAddChoice').modal('toggle');
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

            if (!confirm('@lang('page.confirm_delete')')) return false;

            $.ajax({
                url: route('page.delete', {page: $this.data('pageid') }),
                method: 'DELETE'
            })
                .done(function (result) {
                    if (result.success) {
                        $this.closest('div.col-12').slideUp(1000, function () {
                            $(this).remove();
                        });

                        showToast('success', {
                            heading: '{{ trans('notification.deletion_success_title') }}',
                            text: "{{ trans('notification.deletion_success_text') }}",
                        });
                    }
                })
                .fail(function (data) {
                    console.log('fail');
                    console.log(data);
                    showToast('error', {
                        heading: '{{ trans('notification.deletion_failed_title') }}',
                        text: "{{ trans('notification.deletion_failed_text') }}",
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
            let $parent = $this.closest('.is-page');
            let internalId = {{ $page->id }};

            // Destroy all other summernotes so there is only one open at a time
            $("[id^='content-editable-']:hidden").summernote('destroy');
            $('.toggle-summernote').addClass('clickable').removeClass('summernote-open');

            $this.removeClass('clickable');
            $('#content-' + internalId).addClass('hidden');
            $('#content-editable-' + internalId).removeClass('hidden');
            $('#content-editable-' + internalId + ':visible').summernote(summernoteOptions);

            $this.addClass('summernote-open');
        });

        // Saves the page
        $(document).on('click', '.savePage', function (e) {
            let $this = $(this);
            let currentPageId = {{ $page->id }};

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
                    $('#content-' + currentPageId).html(data.content);
                    showToast('success', {
                        heading: '{{ trans('notification.save_success_title') }}',
                        text: "{{ trans('notification.save_success_text') }}",
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
                        heading: '{{ trans('notification.save_failed_title') }}',
                        text: "{{ trans('notification.save_failed_text') }}",
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
                    url: route('prerequisite.store', {{ $page->id }}),
                    data: data
                })
                    .done(function (data) {
                        if (data.success) {
                            var items = data.prerequisites.items;

                            items.forEach(function (item) {
                                // Adds the new action to the table
                                $('#prerequisites_list-{{ $page->id }} tbody').append(
                                    '<tr>' +
                                    '<td>' + '{{ trans('item.item') }}' + '</td>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td class="text-center">' + '<span class="icon-trash text-danger delete-prerequisite" data-prerequisite_id="' + item.prerequisite_id + '"></span>' + '</td>' +
                                    '</tr>'
                                );
                            });

                            showToast('success', {
                                heading: '{{ trans('notification.save_success_title') }}',
                                text: "{{ trans('notification.save_success_text') }}",
                            });

                            $('#modalCreatePrerequisite').modal('hide');
                        }
                    })
                    .fail(function (data) {
                        showToast('error', {
                            heading: '{{ trans('notification.save_failed_title') }}',
                            text: "{{ trans('notification.save_failed_text') }}",
                            errors: data.responseJSON.errors
                        });
                    })
                    .always(function () {
                        $this.html($this.data('original-text'));
                        $this.prop('disabled', false);
                    });
            }
        });

        showHumanReadableDates();
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

        if (confirm('@lang('page.confirm_delete_link')')) {
            $.ajax({
                url: route('page.choice.delete', {'page': pageTo, 'page_from': pageFrom}),
                method: 'DELETE'
            })
                .done(function (result) {
                    // Delete the link on the tree
                    g.removeEdge(pageFrom, pageTo);
                    render(svg.select("g"), g);

                    showToast('success', {
                        heading: '{{ trans('notification.deletion_success_title') }}',
                        text: "{{ trans('notification.deletion_success_text') }}",
                    });
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: '{{ trans('notification.deletion_failed_title') }}',
                        text: "{{ trans('notification.deletion_failed_text') }}",
                        errors: data.responseJSON.errors
                    });
                });
        }
    });

    // When the author chooses an item from the list
    $(document).on('change', '#item_id', function () {
        var $this = $(this);

        if ($this.val() === '') return false;

        $.post({
            url: route('story.ajax_getitem'),
            data: {'itemId': $this.val()}
        })
            .done(function (data) {
                $('#item_description').html(data);
            });
    });

    // When the author validates the new action on the modal
    $(document).on('click', '#add_CreateAction', function () {
        var $this = $(this);
        var serialized = $('#action_create').serialize();
        let $parent = $this.closest('.modal');

        $.post({
            url: route('actions.store', {{ $page->id }}),
            'data': serialized,
        })
            .done(function (data) {
                if (data.success) {
                    // Show the notification
                    showToast('success', {
                        heading: '{{ trans('notification.save_success_title') }}',
                        text: "{{ trans('notification.save_success_text') }}",
                    });

                    // Adds the new action to the table
                    $('#actions_list tbody').append(
                        '<tr>' +
                        '<td>' + data.action.item.name + '</td>' +
                        '<td>' + data.action.verb + '</td>' +
                        '<td>' + data.action.quantity + '</td>' +
                        '<td>' + data.action.price + '</td>' +
                        '<td class="text-center">' + '<span class="icon-trash text-danger delete-action" data-action_id="' + data.action.item.id + '"></span>' + '</td>' +
                        '</tr>'
                    );

                    // Closes the modal
                    $('#modalCreateAction').modal('hide');
                }
            })
            .fail(function (data) {
                if (data.status === 422) {
                    $.each(data.responseJSON.errors, function (i, error) {
                        $('#modalCreateAction')
                            .find('[name="' + i + '"]')
                            .addClass('input-invalid')
                            .next()
                            .append(error[0])
                            .removeClass('hidden');
                    });
                }
                showToast('error', {
                    heading: '{{ trans('notification.save_failed_title') }}',
                    text: "{{ trans('notification.new_action_not_added') }}",
                    errors: data.responseJSON.errors
                });
            })
            .always(function () {
                $this.html($this.data('original-text'));
                $this.prop('disabled', false);
            });
    });

    // When tu author creates a new riddle
    $(document).on('click', '#add_CreateRiddle', function () {
        var $this = $(this);
        let $parent = $this.closest('.modal');

        $.post({
            url: route('riddle.store', {'page': {{ $page->id }}}),
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
                        heading: '{{ trans('notification.save_success_title') }}',
                        text: "{{ trans('notification.save_success_text') }}",
                    });

                    $('#riddle_table tbody').html('').append(
                        '<tr>' +
                            '<td>' + '@lang('page.riddle_answer_label')' + '</td>' +
                            '<td>' + data.riddle.answer + '</td>' +
                        '</tr>' +
                        (data.riddle.target_page_text != null ?
                        '<tr>' +
                            '<td>' + '@lang('page.riddle_page_text_label')' + '</td>' +
                            '<td>' + data.riddle.target_page_text + '</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td>' + '@lang('page.riddle_target_page_id_label')' + '</td>' +
                            '<td class="font-italic">' + data.page_title + '</td>' +
                            '</tr>'
                            : '') +
                        '<tr>' +
                            '<td>' + '@lang('page.earned_item')' + '</td>' +
                            '<td class="font-italic">' + data.item_name + '</td>' +
                        '</tr>'
                    );

                    // Closes the modal
                    $('#modalCreateAction').modal('hide');
                }
            })
            .fail(function (data) {
                if (data.status === 422) {
                    $.each(data.responseJSON.errors, function (i, error) {
                        $('#modalCreateAction')
                            .find('[name="' + i + '"]')
                            .addClass('input-invalid')
                            .next()
                            .append(error[0])
                            .removeClass('hidden');
                    });
                }
                showToast('error', {
                    heading: '{{ trans('notification.save_failed_title') }}',
                    text: "{{ trans('notification.new_action_not_added') }}",
                    errors: data.responseJSON.errors
                });
            })
            .always(function () {
                $this.html($this.data('original-text'));
                $this.prop('disabled', false);
            });
    });

    $(document).on('click', '.delete-action', function () {
        var $this = $(this);
        var actionId = $this.data('action_id');
        var loadingClass = 'fa fa-circle-o-notch fa-spin';
        var defaultClass = 'icon-trash text-danger';

        if (!$this.hasClass('fa-spin')) {
            $this.attr('class', loadingClass);
        }

        $.ajax({
            url: route('actions.delete', actionId),
            method: 'DELETE'
        })
            .done(function () {
                $this.parents('tr').remove();

                showToast('success', {
                    heading: '{{ trans('notification.deletion_success_title') }}',
                    text: "{{ trans('notification.deletion_success_text') }}",
                });
            })
            .fail(function (data) {
                showToast('error', {
                    heading: '{{ trans('notification.deletion_failed_title') }}',
                    text: "{{ trans('notification.deletion_failed_text') }}",
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
                    heading: '{{ trans('notification.deletion_success_title') }}',
                    text: "{{ trans('notification.deletion_success_text') }}",
                });
            })
            .fail(function (data) {
                showToast('error', {
                    heading: '{{ trans('notification.deletion_failed_title') }}',
                    text: "{{ trans('notification.deletion_failed_text') }}",
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
</script>
