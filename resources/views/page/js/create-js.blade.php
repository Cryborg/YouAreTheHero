<script type="text/javascript">
    function newPage($this, route, disableEdit) {
        disableEdit = disableEdit || false;

        var newNumber = $('a.nav-item.nav-link').length;
        $('a.nav-item.nav-link, div.tab-pane').removeClass('active');

        $('#addNewPage').before(
            '<a class="nav-item nav-link active" href="#p' + newNumber + '" data-toggle="tab">' +
            '<span class="choice_title_' + newNumber + '">' +
            '<input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-' + newNumber + '">' +
            '<div class="alert alert-error hidden"></div>' +
            '</span></span>' +
            '</a>'
        );
        $.ajax({
            'url': route,
            'data': {'internalId': newNumber}
        })
            .done(function (data) {
                $('#choicesForm').append('<div class="tab-pane active" id="p' + newNumber + '">' + data + '</div>');

                if (disableEdit) {
                    var $newPageSelector = $('#p' + newNumber);

                    $newPageSelector.find('textarea, input').prop('disabled', true);
                } else {
                    //$('#choicesForm > div.tab-pane.active textarea').summernote(summernoteOptions);
                }
            })
            .always(function () {
                $this.prop('disabled', false);
            });
    }

    $(document).ready(function () {
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

        $(document).on('click', '.toggle-summernote', function () {
            let $this = $(this);
            let $parent = $this.closest('.menu-bar-left');
            let internalId = $parent.data('internalid');

            $('#content-' + internalId).summernote({focus: true});

            // Change the icon
            $this.removeClass('toggle-summernote glyphicon-edit').addClass('submit-btn glyphicon-floppy-disk');
        });

        $(document).on('click', '.submit-btn', function (e) {
            let $this = $(this);
            let $parent = $this.closest('.menu-bar-left');

            // internalId is 0 if the form being submitted is the main page.
            // Otherwise it is > 0
            let internalId = $parent.data('internalid');
            let $form = $("div.divAsForm[data-internalid='" + internalId + "']");

            $('#content-' + internalId).summernote('destroy');

            var data = {
                'title': $('#title-' + internalId).val(),
                'content': $('#content-' + internalId).html(),
                'layout': $('#layout-' + internalId).val(),
                'is_first': $('#is_first-' + internalId).is(":checked") ? 1 : 0,
                'is_last': $('#is_last-' + internalId).is(":checked") ? 1 : 0,
                'is_checkpoint': $('#is_checkpoint-' + internalId).is(":checked") ? 1 : 0,
            };
            if (internalId > 0) {
                data.linktitle = $('#linktext-' + internalId).val();
                data.page_from = $('#page_from').val();
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

                    $this.addClass('toggle-summernote glyphicon-edit').removeClass('submit-btn glyphicon-floppy-disk');
                });
        });

        $('#add_CreatePrerequisite').on('click', function () {
            var $this = $(this);
            var data = {};

            // If the "item" tab is selected
            if ($('#tr1').hasClass('active')) {
                data = {
                    'items': $('#prerequisite_item_id').val(),
                    'quantity': $('#prerequisite_quantity').val()
                };
            }

            // If the "stats" tab is selected
            if ($('#tr2').hasClass('active')) {
                if ($('#sheet option:selected').val() !== '') {
                    var key = $('#sheet option:selected').text();
                    var value = $('#level').val();

                    data['stats'] = {};
                    data['stats'][key] = value;
                }
            }

            if (Object.entries(data).length > 0 && data.constructor === Object) {
                $.post({
                    url: route('prerequisite.store', '{{ $page->uuid }}'),
                    data: data
                })
                    .done(function (data) {
                        if (data.success) {
                            var items = data.prerequisites.items;

                            items.forEach(function (item) {
                                // Adds the new action to the table
                                $('#prerequisites_list tbody').append(
                                    '<tr>' +
                                    '<td>' + '{{ trans('item.item') }}' + '</td>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td>' + '<span class="glyphicon glyphicon-trash-red delete-prerequisite" data-prerequisite_id="' + item.prerequisite_id + '"></span>' + '</td>' +
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

        function ajaxCreatePost(route, $this, data)
        {
            var commonData = {
                'story_id': {{ $story->id }}
            };

            $.post({
                url: route,
                data: {...data, ...commonData}
            })
                .done(function (data) {
                    showToast('success', {
                        heading: '{{ trans('notification.save_success_title') }}',
                        text: "{{ trans('notification.save_success_text') }}",
                    });

                    // Add the newly created item to both lists
                    $('#prerequisite_item_id, #item_id, #riddle_item').append(
                        '<option value="' + data.item.id + '">' + data.item.name + '</option>'
                    );
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

        @for ($i = 0, $iMax = count($contexts); $i < $iMax; $i++)
            $('#create_item_{{ $contexts[$i] }}').on('click', function () {
                var $this = $(this);
                var route = '{{ route('item.store') }}';
                var values = [];

                $('input[name="stat_values[]"]:visible').each(function () {
                    values.push({
                        'id': $(this).data('id'),
                        'value': $(this).val()
                    });
                });

                ajaxCreatePost(route,  $this, {
                    'name': $('#item_name_{{ $contexts[$i] }}').val(),
                    'default_price': $('#item_price_{{ $contexts[$i] }}').val(),
                    'single_use': $('#single_use_{{ $contexts[$i] }}').is(':checked') ? 1 : 0,
                    'effects': values
                })
            });
        @endfor
    });

    $(document).on('click', '#listAllPages tr', function () {
        window.location.href = route('page.edit', {'page': $(this).data('pageid')});
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

        if ($this.val() === 0) return false;

        $this.prop('disabled', true);

        newPage($this, route('page.create', [{{ $page->story_id }}, $this.val()]), true);

        $("#childrenSelect option:selected").remove();
    });

    // When the author validates the new action on the modal
    $('#add_CreateAction').on('click', function () {
        var serialized = $('#action_create').serialize();
        var $this = $(this);

        $.post({
            url: '{{ route('actions.store', $page->uuid) }}',
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
                        '<td>' + '<span class="glyphicon glyphicon-trash-red delete-action" data-action_id="' + data.action.item.id + '"></span>' + '</td>' +
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

        $.post({
            url: '{{ route('riddle.store', $page->uuid) }}',
            'data': {
                'answer': $('#riddle_answer_text').val(),
                'type': $('#answer_is_integer').is(':checked') ? 1 : 0,
                'item_id': $('#riddle_item option:selected').val(),
                'target_page': $('#riddle_page option:selected').val(),
                'target_text': $('#riddle_target_text').val(),
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
                            '<td>' + data.riddle.target_text + '</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td>' + '@lang('page.riddle_target_page_label')' + '</td>' +
                            '<td class="font-italic">' + data.page_title + '</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td>' + '@lang('page.concerned_item')' + '</td>' +
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
        var defaultClass = 'glyphicon glyphicon-trash-red';

        if (!$this.hasClass('fa-spin')) {
            $this.attr('class', loadingClass);
        }

        $.ajax({
            url: route('actions.delete', actionId),
            method: 'DELETE'
        })
            .done(function () {
                actionsListDatatable
                    .row($this.parents('tr'))
                    .remove()
                    .draw();
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
        var defaultClass = 'glyphicon glyphicon-trash-red';

        if (!$this.hasClass('fa-spin')) {
            $this.attr('class', loadingClass);
        }

        $.ajax({
            url: route('prerequisite.delete', prerequisiteId),
            method: 'DELETE'
        })
            .done(function () {
                prerequisitesListDatatable
                    .row($this.parents('tr'))
                    .remove()
                    .draw();
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
