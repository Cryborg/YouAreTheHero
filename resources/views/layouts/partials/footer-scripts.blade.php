<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.connections.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/js.cookie.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/input_number.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

@if (Config::get('app.locale') !== 'en_GB')
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/moment-lang.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/summernote.js') }}"></script>
@endif
<script type="text/javascript">
    moment.locale('fr');

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

    // Put a spinner on buttons, but only if they have the 'original-text' data attribute.
    $(document).on('click', function(element) {
        var $this = $(element.target);

        if (typeof $this.data('original-text') != 'undefined') {
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> ' + $this.data('original-text');

            if ($this.html() !== loadingText) {
                $this.data('original-text', $this.html());
                $this.html(loadingText);
                $this.prop('disabled', true);
            }
        }
    });

    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            "url": "{{ asset('lang/' . Config::get('app.locale') . '/datatables.json') }}"
        },
    } );

    function resetLoader($button)
    {
        $button.html($button.data('original-text'));
        $button.prop('disabled', false);
    }

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
                toastOptions.hideAfter = 10000;
                break;
        }

        var text = data.text + '<ul>';

        $.each(data.errors, function (key, value) {
            text += '<li>' + value + '</li>';
        });

        text += '</ul>';

        $.toast(Object.assign(toastOptions, {
            heading: '<b>' + data.heading + '</b>',
            text: text,
            icon: icon,
            bgColor: bgColor
        }));
    }

    var PlaceholdersButton = function (context) {
        var ui = $.summernote.ui;
        var placeholders = {
            'character_name': '{{ trans('character.name_label') }}'
        };

        // create button
        var buttonGroup = ui.buttonGroup([
            ui.button({
                className: 'dropdown-toggle',
                contents: '<i class="fa fa-cog"/> {{ trans('page.variables_label') }}',
                tooltip: 'hello',
                data: {
                    toggle: 'dropdown'
                },
                click: function() {
                    // Cursor position must be saved because is lost when dropdown is opened.
                    context.invoke('editor.saveRange');
                }
            }),
            ui.dropdown({
                className: 'drodown-style',
                items: ['character_name'],
                callback: function ($dropdown) {
                    $dropdown.find('a.dropdown-item').each(function () {
                        $(this).html(placeholders[$(this).data('value')]);
                        $(this).click(function(e) {
                            // We restore cursor position and text is inserted in correct pos.
                            context.invoke('editor.restoreRange');
                            context.invoke('editor.focus');
                            context.invoke("editor.insertText", '[[' + $(this).data('value') + ']]');
                            e.preventDefault();
                        });
                    });
                }
            })
        ]);
        return buttonGroup.render();   // return button as jquery object
    };


    var summernoteOptions = {
        lang: 'fr-FR',
        maximumImageFileSize: 524288, // 512k
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']],
            ['custom', ['placeholders']],
        ],
        buttons: {
            placeholders: PlaceholdersButton
        },
        spellcheck: false
    };

    $('textarea').summernote(summernoteOptions);

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
