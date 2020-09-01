    $(document).ready(function () {
        function checkForm() {
            var correct = true;

            // No field can be empty
            $('input.new_field').each(function () {
                if ($(this).val() === '') {
                    correct = false;
                    $(this).addClass('input-invalid');
                } else {
                    $(this).removeClass('input-invalid');
                }
            });

            // Min value should be less than max value, or equal
            if ($('#max_value').val() < $('#min_value').val()) correct = false;

            return correct;
        }

        // Delete a character_field
        $(document).on('click touchstart keydown', '.deleteCharacterField', function () {
            var $this = $(this);
            var id = $this.data('field_id');
            var loadingClass = 'fa fa-circle-o-notch fa-spin';
            var defaultClass = 'icon-trash text-danger';

            if (!$this.hasClass('fa-spin')) {
                $this.attr('class', loadingClass);
            }

            $.get({
                url: route('field.delete', {field: id}),
                method: 'DELETE'
            })
                .done(function (result) {
                    if (result.success) {
                        $this.closest('tr').remove();

                        showToast('success', {
                            heading: "{{ trans('notification.save_success_title') }}",
                            text: "{{ trans('notification.save_success_text') }}",
                        });
                    }
                })
                .fail(function (data) {
                    showToast('error', {
                        heading: "{{ trans('notification.deletion_failed_title') }}",
                        text: "{{ trans('notification.deletion_failed_text') }}",
                        errors: data.responseJSON.errors
                    });
                })
                .always(function () {
                    $this.attr('class', defaultClass);
                });
        });

        $(document).on('click touchstart keydown', '.addField', function () {
            if (checkForm()) {
                $.post({
                    url: route('field.store', {'story': storyId}),
                    data: {
                        'name': $('#name').val(),
                        'short_name': $('#short_name').val(),
                        'hidden': $('#hidden_field').is(':checked') ? 1 : 0,
                        'min_value': $('#min_value').val(),
                        'max_value': $('#max_value').val()
                    }
                })
                    .done(function (result) {
                        if (result.success) {
                            var html = '<tr>' +
                                '<td><div>' + result.field.name + '</div></td>' +
                                '<td><div>' + result.field.short_name + '</div></td>' +
                                '<td><div>' + result.field.min_value + '</div></td>' +
                                '<td><div>' + result.field.max_value + '</div></td>' +
                                '<td class="text-center"><div><input type="checkbox" value="1" ' +
                                    (result.field.hidden ? 'checked' : '') +
                                '></div></td>' +
                                '<td class="text-center"><div><span class="icon-trash text-danger deleteCharacterField" data-field_id="' + result.field.id + '"></span></div></td>' +
                                '</tr>';
                            $('#stats_story').append(html);

                            showToast('success', {
                                heading: "{{ trans('notification.save_success_title') }}",
                                text: "{{ trans('notification.save_success_text') }}",
                            });

                            $('#name, #short_name').val('');
                            $('#min_value').val('1');
                            $('#max_value').val('10');
                            $('#name').focus();
                        }
                    })
                    .fail(function (data) {
                        showToast('error', {
                            heading: saveFailedHeading,
                            text: saveFailedText,
                            errors: data.responseJSON.errors
                        });
                    });
            }
        });

        $(document).on('click touchstart keydown', '#pills-options .form-check-input', function () {
            const $this = $(this);
            const id = $this.attr('id');
            const value = $('#' + id).is(':checked');

            saveOption(id, value);
        });
    });

    $(document).on('blur', '#inventory_slots', function () {
        const $this = $(this);

        saveOption('inventory_slots', $this.val());
    });

    function saveOption(id, value) {
        $.post({
            url: route('story.options.post', {'story': storyId}),
            data: {option: id, value: value}
        })
        .done(function (data) {
            if (data.success) {
                if (value) {
                    $('#pills-sheet-tab').removeClass('hidden');
                } else {
                    $('#pills-sheet-tab').addClass('hidden');
                }
                showToast('success', {
                    heading: "{{ trans('notification.save_success_title') }}",
                    text: "{{ trans('notification.save_success_text') }}"
                });
            }
        })
        .fail(function (data) {
            showToast('error', {
                heading: "{{ trans('notification.save_failed_title') }}",
                text: "{{ trans('notification.save_failed_text') }}"
            });
        });
    }
