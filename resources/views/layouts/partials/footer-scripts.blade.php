<!-- Hotjar Tracking Code for https://www.youarethehero.fr -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2040780,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- End Hotjar -->

<script src="{{ asset('js/d3.v5.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/graphlib-dot.js') }}"></script>
<script src="{{ asset('js/dagre-d3.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.connections.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/js.cookie.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/summernote-cleaner.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-input-spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/splide/dist/js/splide.min.js') }}"></script>

@if (Config::get('app.locale') !== 'en_GB')
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/moment-lang.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/summernote.js') }}"></script>
@endif

<script type="text/javascript">
    // Common translations
    var saveSuccessHeading = "{!! trans('notification.save_success_title') !!}";
    var saveSuccessText = "{!! trans('notification.save_success_text') !!}";
    var saveFailedHeading = "{!! trans('notification.save_failed_title') !!}";
    var saveFailedText = "{!! trans('notification.save_failed_text') !!}";
    var deletionSuccessTitle = "{{ trans('notification.deletion_success_title') }}";
    var deletionSuccessText = "{{ trans('notification.deletion_success_text') }}";
    var deletionFailedTitle = "{{ trans('notification.deletion_failed_title') }}";
    var deletionFailedText = "{{ trans('notification.deletion_failed_text') }}";

    var commonErrorText = "@lang('common.error')";

    @include('layouts.partials.common-js')

    // Image slider on the login page
    if ($('.splide').length > 0) {
        new Splide('.splide', {
            type: 'loop',
            lazyLoad: 'nearby',
        }).mount();
    }

    var modalSplide = null;

    $(document).on('click touchstart keydown', 'img.preview', function () {
        $('#modalImage').modal();

        if (modalSplide === null) {
            modalSplide = new Splide('#modal-splide', {
                type: 'loop',
                lazyLoad: 'nearby',
            }).mount();
        }
    });

    $(document)
        // Global settings for AJAX requests
        .ajaxComplete(function (event, request, settings) {
            let data = request.responseJSON;

            // If the session has expired
            if (request.status === 419) {
                alert('You have been inactive for the last minutes, please refresh the page to reconnect.');
            }

            // Instantiate popovers on newly created HTML elements
            $('[data-toggle="popover"]').popover({
                animation: false,
                html: true
            });

            // Refreshes some partials if the appropriate JSON response is true
            if (data) {
                if (data.refreshInventory === true) {
                    loadInventory();
                }
                if (data.refreshChoices === true) {
                    loadChoices();
                }
                if (data.refreshSheet === true) {
                    loadSheet();
                }
                if (data.refreshPurse === true) {
                    loadPurse();
                }

                // Shows an informational toast
                switch (data.type) {
                    case 'save':
                        if (data.success) {
                            showToast('success', {
                                heading: saveSuccessHeading,
                                text: data.message || saveSuccessText,
                            });
                        } else {
                            showToast('error', {
                                heading: saveFailedHeading,
                                text: data.message || saveFailedText,
                                errors: data.errors
                            });
                        }
                        break;
                    case 'delete':
                        if (data.success) {
                            showToast('success', {
                                heading: deletionSuccessTitle,
                                text: data.message || deletionSuccessText,
                            });
                        } else {
                            showToast('error', {
                                heading: deletionFailedTitle,
                                text: data.message || deletionFailedText,
                                errors: data.errors
                            });
                        }
                        break;
                }
            }
        })
    ;

    $(document).on('hide.bs.modal', function (event) {
        $(this).find('button').prop('disabled', false);
    });

    function resetLoader($button)
    {
        $button.html($button.data('original-text'));
        $button.prop('disabled', false);
    }

    $('input, select, textarea').on('keypress', function () {
        const $this = $(this);
        if ($this.hasClass('input-invalid')) {
            $this.next().hide();
            $this.removeClass('input-invalid');
        }
    });

    const PlaceholdersButton = function (context) {
        const ui = $.summernote.ui;
        const content = "{!! includeAsJsString('story.js.partials.placeholders', ['placeholders' => $placeholders ?? []]) !!}";

        // create button
        const buttonGroup = ui.buttonGroup([
            ui.button({
                className: 'dropdown-toggle',
                contents: '<i class="fa fa-cog"/> {{ trans('page.wysiwyg_people_label') }}',
                tooltip: 'Insert variables into text',
                data: {
                    toggle: 'dropdown'
                },
                click: function () {
                    // Cursor position must be saved because it is lost when dropdown is opened.
                    context.invoke('editor.saveRange');
                }
            }),
            ui.dropdown({
                contents: content,
                callback: function ($dropdown) {
                    $dropdown.find(".clickable").click(function () {
                        // We restore cursor position and text is inserted in correct pos.
                        context.invoke('editor.restoreRange');
                        context.invoke('editor.focus');
                        context.invoke("editor.insertText", '[[' + $(this).data('value') + ']]');
                    });
                },
            })
        ]);

        return buttonGroup.render();   // return button as jquery object
    };

    const PopoverButton = function (context) {
        var $this = $(this);
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<span data-target="#modalDescriptions" data-toggle="modal">@lang('description.descriptions_button_label')</span>',
            tooltip: 'Add inline descriptions',
            click: function () {
                $('.savePage').addClass('disabled');
            }
        });

        return button.render();
    };

    const ExampleButton = function (context) {
        var ui = $.summernote.ui;
        var pdfButton = ui.buttonGroup([
            ui.button({
                className: "dropdown-toggle",
                contents:
                    '<span class="fa fa-file-pdf-o"></span> <span class="caret"></span>',
                tooltip: "Your tooltip",
                data: {
                    toggle: "dropdown",
                },
            }),
            ui.dropdown({
                className: "drop-default summernote-list",
                contents:
                    '<div class="btn-group">' +
                    '<button type="button" class="btn btn-default btn-sm" title="PDF 1"><i class="fa fa-file-pdf-o"></i>PDF 1</button>' +
                    '<button type="button" class="btn btn-default btn-sm" title="PDF 2"><i class="fa fa-file-pdf-o"></i>PDF 2</button></div>',
                callback: function ($dropdown) {
                    $dropdown.find(".btn").click(function () {
                        context.invoke("editor.insertText", "text");
                    });
                },
            }),
        ]);

        return pdfButton.render(); // jquery object
    };

    const summernoteOptions = {
        lang: 'fr-FR',
        height: 300,
        maximumImageFileSize: 524288, // 512k
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']],
            ['custom', ['cleaner','placeholders', 'popovers', 'example']],
        ],
        buttons: {
            placeholders: PlaceholdersButton,
            popovers: PopoverButton,
            example: ExampleButton
        },
        spellcheck: false,
        cleaner: {
            action: 'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, 'both' does both options.
            newline: '<br>', // Summernote's default is to use '<p><br></p>'
            notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
            icon: '<i class="note-icon">Clean</i>',
            keepHtml: true, // Remove all Html formats
            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>', '<i>', '<a>', '<img>'], // If keepHtml is true, remove all tags except these
            keepClasses: false, // Remove Classes
            badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
            badAttributes: ['style', 'start'], // Remove attributes from remaining tags
            limitChars: false, // 0/false|# 0/false disables option
            limitDisplay: 'both', // text|html|both
            limitStop: false, // true/false
            showOutput: false
        },
        focus: true,
        callbacks: {
            onBlur: function (e) {
                var p = e.target.parentNode.parentNode

                // Only trigger if we don't click in the Summernote toolbar
                if (!(e.relatedTarget && $.contains(p, e.relatedTarget))) {
                    $('.savePage').trigger('click');
                }
            }
        }
    };

    const summernoteOptionsLight = {
        lang: 'fr-FR',
        maximumImageFileSize: 524288, // 512k
        toolbar: [
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['picture']],
        ],
        spellcheck: false,
        focus: true
    };

    function loadInputSpinner() {
        $("input[type='number']").inputSpinner({
            'buttonsClass': 'btn-attribute btn-outline-secondary w-100'
        });
    }

    const loadingSpinner = '<div class="d-flex justify-content-center w-100"><div class="spinner-grow text-success" role="status"></div></div>';
</script>
