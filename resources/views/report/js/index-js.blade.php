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
            }
        });
});
