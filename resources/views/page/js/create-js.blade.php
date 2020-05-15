<script type="text/javascript">
    function newPage($this, route) {
        $('a.nav-item.nav-link, div.tab-pane').removeClass('active');

        // Create the page and display it
        $.ajax({
            'url': route,
            'data': {
                'page_from': $this.data('page-from')
            },
            'method': 'POST'
        })
            .done(function (data) {
                $('#choicesForm').append('<div class="tab-pane active" id="p' + data.page.id + '">' + data.view + '</div>');

                // Create the tab
                $('#addNewPage').before(
                    '<a class="nav-item nav-link active" href="#p' + data.page.id + '" data-toggle="tab">' +
                    '<span class="choice_title_' + data.page.id + '">' +
                    '<input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-' + data.page.id + '">' +
                    '<div class="alert alert-error hidden"></div>' +
                    '</span></span>' +
                    '</a>'
                );
            })
            .always(function () {
                $this.prop('disabled', false);
            });
    }

    $(document).ready(function () {

        // Delete a page
        $('.menu-icon-bottom.glyphicon-trash, .card .glyphicon-trash').on('click', function ()
        {
            if (!confirm('@lang('page.confirm_delete')')) return false;

            var $this = $(this);
            var pageId = $this.data('pageid');

            $.ajax({
                url: route('page.delete', {'page': pageId }),
                method: 'DELETE'
            })
                .done(function (result) {
                    if (result.success) {
                        window.location.href = result.redirectTo;
                    }
                })
        });

        $('#modalCreatePrerequisite,#modalCreateAction,#modalCreateRiddle').on('show.bs.modal', function (event) {
            var $this = $(this);
            var $parent = $(event.relatedTarget);
            var myVal = $parent.data('pageid');
            $this.data('pageid', myVal);
        });

        // help-block state check from cookie
        var openToggle = Cookies.get("hero.help-block.show") || false;

        if (openToggle === 'true') {
            $("p.help-block").show();
        } else {
            $("p.help-block").hide();
        }

        $('.toggle-help').on('click', function () {
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

        // Create a new tab with a new page
        $('#addNewPage').on('click', function (event) {
            event.preventDefault();

            var $this = $(this);
            $this.prop('disabled', true);

            newPage($this, route('page.create', {{ $page->story_id }}));
        });

        // Display Summernote editor on the clicked div
        $(document).on('click', '.toggle-summernote:not(.summernote-open)', function () {
            let $this = $(this);
            let $parent = $this.closest('.is-page');
            let internalId = $parent.data('pageid');

            // Destroy all other summernotes so there is only one open at a time
            $("[id^='content-']:hidden").summernote('destroy');

            $this.removeClass('clickable');
            $('#content-' + internalId + ':visible').summernote(summernoteOptions);
            $this.addClass('summernote-open');
        });

        // Saves the page
        $(document).on('click', '.glyphicon-floppy-disk', function (e) {
            let $this = $(this);
            let $parent = $this.closest('.is-page');
            let internalId = $parent.data('pageid');
            let $form = $("div.is-page[data-pageid='" + internalId + "']").find('.divAsForm');

            $('#content-' + internalId + ':hidden').summernote('destroy');
            $('.toggle-summernote').addClass('clickable').removeClass('summernote-open');

            var data = {
                'title': $('#title-' + internalId).val(),
                'content': $('#content-' + internalId).html(),
                'layout': $('#layout-' + internalId).val(),
                'is_first': $('#is_first-' + internalId).is(":checked") ? 1 : 0,
                'is_last': $('#is_last-' + internalId).is(":checked") ? 1 : 0,
                'is_checkpoint': $('#is_checkpoint-' + internalId).is(":checked") ? 1 : 0,
                'page_from': $this.data('page-from')
            };

            if ($('#linktext-' + internalId).length > 0) {
                data.link_text = $('#linktext-' + internalId).val();
            }

            $.post({
                url: $form.data('route'),
                data: data
            })
                .done(function (data) {
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

        $('#add_CreatePrerequisite').on('click', function () {
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
                    url: route('prerequisite.store', $parent.data('pageid')),
                    data: data
                })
                    .done(function (data) {
                        if (data.success) {
                            var items = data.prerequisites.items;

                            items.forEach(function (item) {
                                // Adds the new action to the table
                                $('#prerequisites_list-' + $parent.data('pageid') + ' tbody').append(
                                    '<tr>' +
                                    '<td>' + '{{ trans('item.item') }}' + '</td>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td class="text-center">' + '<span class="glyphicon glyphicon-trash text-danger delete-prerequisite" data-prerequisite_id="' + item.prerequisite_id + '"></span>' + '</td>' +
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

    // When the author chooses an item from the list
    $('#item_id').on('change', function () {
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

    // When the author creates a link to an existing page
    $('.nav-item.nav-link select').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);

        if (parseInt($this.val()) === 0) return false;

        $this.prop('disabled', true);

        newPage($this, route('page.create', [{{ $page->story_id }}, $this.val()]));

        $("#childrenSelect option:selected").remove();
    });

    // When the author validates the new action on the modal
    $('#add_CreateAction').on('click', function () {
        var $this = $(this);
        var serialized = $('#action_create').serialize();
        let $parent = $this.closest('.modal');

        $.post({
            url: route('actions.store', $parent.data('pageid')),
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
                        '<td class="text-center">' + '<span class="glyphicon glyphicon-trash text-danger delete-action" data-action_id="' + data.action.item.id + '"></span>' + '</td>' +
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
    $('#add_CreateRiddle').on('click', function () {
        var $this = $(this);
        let $parent = $this.closest('.modal');

        $.post({
            url: route('riddle.store', {'page': $parent.data('pageid')}),
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
                        '<tr>' +
                            '<td>' + '@lang('page.riddle_page_text_label')' + '</td>' +
                            '<td>' + data.riddle.target_page_text + '</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td>' + '@lang('page.riddle_target_page_id_label')' + '</td>' +
                            '<td class="font-italic">' + data.page_title + '</td>' +
                        '</tr>' +
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
        var defaultClass = 'glyphicon glyphicon-trash text-danger';

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
        var defaultClass = 'glyphicon glyphicon-trash text-danger';

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
</script>
