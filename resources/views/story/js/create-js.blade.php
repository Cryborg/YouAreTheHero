<script type="text/javascript">
    $(document).ready(function () {
        var statsDatatable = $('#stats_story').DataTable({
            dom: 't',
            columnDefs: [
                {
                    "targets": [ 4 ],
                    "sortable": false,
                    "searchable": false
                }
            ],
            createdRow: function(row, data, dataIndex) {
                $(row).children('td').eq(4).addClass('text-center');
            }
        });

        function checkForm() {
            var correct = true;

            // No field can be empty
            $('input.new_stat').each(function () {
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

        $(document).on('click', '.glyphicon-trash', function () {
            var $this = $(this);
            var id = $this.data('statstory_id');
            var loadingClass = 'fa fa-circle-o-notch fa-spin';
            var defaultClass = 'glyphicon glyphicon-trash text-danger';

            if (!$this.hasClass('fa-spin')) {
                $this.attr('class', loadingClass);
            }

            $.get({
                url: route('stat.delete', {stat_story: id}),
                method: 'DELETE'
            })
                .done(function (result) {
                    if (result.success) {
                        statsDatatable
                            .row($this.parents('tr'))
                            .remove()
                            .draw();

                        showToast('success', {
                            heading: '{{ trans('notification.save_success_title') }}',
                            text: "{{ trans('notification.save_success_text') }}",
                        });
                    }
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

        $(document).on('click', '.glyphicon-plus-sign', function () {
            if (checkForm()) {
                $.post({
                    url: route('stat.store', {'story': {{ $story->id }} }),
                    data: {
                        'full_name': $('#full_name').val(),
                        'short_name': $('#short_name').val(),
                        'min_value': $('#min_value').val(),
                        'max_value': $('#max_value').val(),
                    }
                })
                    .done(function (result) {
                        if (result.success) {
                            statsDatatable.row.add([
                                result.statStory.full_name,
                                result.statStory.short_name,
                                result.statStory.min_value,
                                result.statStory.max_value,
                                '<span class="glyphicon glyphicon-trash text-danger" data-statstory_id="' + result.statStory.id + '"></span>'
                            ]).draw();

                            showToast('success', {
                                heading: '{{ trans('notification.save_success_title') }}',
                                text: "{{ trans('notification.save_success_text') }}",
                            });

                            $('#full_name, #short_name, #min_value, #max_value').val('');
                            $('#full_name').focus();
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

                    });
            }
        });

        $(document).on('click', '#pills-options .form-check-input', function () {
            var $this = $(this);
            var id = $this.attr('id');
            var value = $('#' + id).is(':checked');

            $.post({
                url: route('story.options.post', {'story': {{ $story->id }} }),
                data: {option: id, value: value}
            })
                .done(function (data) {
                    if (data.success) {
                        showToast('success', {
                            heading: '{{ trans('notification.save_success_title') }}',
                            text: "{{ trans('notification.save_success_text') }}",
                        });
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
                });
        });
    });
</script>
