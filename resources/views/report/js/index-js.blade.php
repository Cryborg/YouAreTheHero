$(document).ready(function () {
    showHumanReadableDates();
});

$(document).on('click touchstart keydown', '.deleteReport', function () {
    var $this = $(this);
    var $reportId = $this.data('reportid');

    $.ajax({
        url: route('report.delete', {'report': $reportId }),
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
        });
});
