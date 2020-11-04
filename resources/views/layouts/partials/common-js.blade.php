moment.locale('fr');

// Global ajax options
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Put a spinner on buttons, but only if they have the 'original-text' data attribute.
$(document).on('click touchstart keydown', 'button', function(element) {
    const $this = $(element.target);

    if (typeof $this.data('original-text') != 'undefined') {
        const loadingText = '<div><div class="spinner-grow spinner-grow-sm text-success position-absolute" role="status"></div> <div class="invisible">' + $this.data('original-text') + '</div></div>';
        if ($this.html() !== loadingText) {
            $this.data('original-text', $this.html());
            $this.html(loadingText);
            $this.prop('disabled', true);
        }
    }
});

// Global options for toasts
var toastOptions = {
    showHideTransition: 'fade', // fade, slide or plain
    allowToastClose: true, // Boolean value true or false
    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
    position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

    textAlign: 'center',  // Text alignment i.e. left, right or center
    loader: true,  // Whether to show loader or not. True by default
    loaderBg: '#9EC600',  // Background color of the toast loader
};

function showToast(type, data) {
    // Default color and icon for success type
    let icon;
    let bgColor = '#38c172';
    let text;

    switch (type) {
        case 'error':
            data.heading = data.heading || commonErrorText;
            icon = 'error';
            bgColor = '#e3342f';
            toastOptions.hideAfter = 10000;
            break;

        // The user gains a new Success
        case 'user_success':
            data.heading = data.heading || null;
            text = data.description;
            bgColor = 'deepskyblue';
            toastOptions.hideAfter = 10000;
            break;
        default:
            icon = 'success';
    }

    text = text || data.text + '<ul>';

    $.each(data.errors, function (key, value) {
        text += '<li>' + value + '</li>';
    });

    text += '</ul>';

    $.toast(Object.assign(toastOptions, {
        heading: '<b>' + data.heading + '</b>',
        text: text,
        icon: icon,
        bgColor: bgColor,
    }));
}

$('div.alert').not('.alert-important, .alert-dismissible').delay(3000).fadeOut(350);

$(function () {
    $('[data-toggle="tooltip"]')
        .data('html', true)
        .tooltip({
            'template': '<div class="tooltip bg-white text-dark" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        });
    $(function () {
        $('[data-toggle="popover"]').popover({
            animation: false,
            html: true
        })
    });

});

// Convert dates to human readable strings
function showHumanReadableDates() {
    $('.moment_date').each(function (id, elt) {
        var originalDate = $(elt).html();
        var momentDate = moment(originalDate, 'YYYY-MM-DD h:mm:ss').fromNow();

        if (momentDate) {
            $(elt)
                .html(momentDate)
                .attr('title', originalDate);
        }
    });
}
