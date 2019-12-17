<!-- Bootstrap core JavaScript
================================================= -->
<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script src="{{ asset('js/js.cookie.min.js') }}"></script>
<script type="text/javascript">
    // Global ajax options
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Loading screen
    var $loading = $('#loadingDiv').hide();

    $(document)
        .ajaxStart(function () {
            $loading.show();
        })
        .ajaxStop(function () {
            $loading.hide();
        });

    $('input, select, textarea').on('keypress', function () {
        var $this = $(this);
        if ($this.hasClass('input-invalid')) {
            $this.next().hide();
            $this.removeClass('input-invalid');
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
        var icon = 'success';
        var bgColor = '#38c172';

        switch (type) {
            case 'error':
                icon = 'error';
                bgColor = '#e3342f';
                break;
        }

        $.toast(Object.assign(toastOptions, {
            heading: '<b>' + data.heading + '</b>',
            text: data.text,
            icon: icon,
            bgColor: bgColor
        }));
    }
</script>
