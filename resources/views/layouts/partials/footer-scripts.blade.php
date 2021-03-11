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
<script type="text/javascript" src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-input-spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/splide/dist/js/splide.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

@if (Config::get('app.locale') !== 'en_GB')
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/moment-lang.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/summernote.js') }}"></script>
@endif

{{--Summernote plugins--}}
<script type="text/javascript" src="{{ asset('js/summernote-cleaner.js') }}"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('.datatable').DataTable({
            'language': {
                'url': "{{ asset('lang/fr_FR/datatables-fr.json') }}"
            },
            'dom': '<"float-left"f>t<"float-left"p>',
            'aaSorting': []
        });
    } );

    // Common translations
    const saveSuccessHeading = "{!! trans('notification.save_success_title') !!}";
    const saveSuccessText = "{!! trans('notification.save_success_text') !!}";
    const saveFailedHeading = "{!! trans('notification.save_failed_title') !!}";
    const saveFailedText = "{!! trans('notification.save_failed_text') !!}";
    const deletionSuccessTitle = "{{ trans('notification.deletion_success_title') }}";
    const deletionSuccessText = "{{ trans('notification.deletion_success_text') }}";
    const deletionFailedTitle = "{{ trans('notification.deletion_failed_title') }}";
    const deletionFailedText = "{{ trans('notification.deletion_failed_text') }}";
    const commonErrorText = "@lang('common.error')";
    const commonSaveText = "@lang('common.save')";
    const commonInactiveMessage = "@lang('common.inactive')";
    const storyEditText = "@lang('story.edit_content')";
    const VariablesButtonTooltip = "{{ trans('variables.help') }}";
    const descriptionButtonText = "@lang('description.descriptions_button_label')";
    const VariablesButtonButtonContent = "{{ trans('variables.label') }}";

    // Dynamic views
    const PlaceholdersButtonContent = "{!! includeAsJsString('story.js.partials.placeholders', ['placeholders' => $placeholders ?? []]) !!}"
    const FunctionsButtonContent = "{!! includeAsJsString('story.js.partials.functions') !!}";
    const loadingSpinner = "{!! includeAsJsString('partials.overlay_spinner') !!}";
    @isset ($story)
        const VariablesButtonContent = "{!! includeAsJsString('story.js.partials.variables', ['story' => $story]) !!}";
    @endisset

    @if (Session::has('successes'))
        @foreach (Session::get('successes') as $success)
            showToast('user_success', {
                heading: '{!! $success['heading'] !!}',
                description: '{!! $success['description'] !!}'
            });
        @endforeach
    @endif

    // Image slider on the login page
    if ($('.splide').length > 0) {
        new Splide('.splide', {
            type: 'loop',
            lazyLoad: 'nearby',
        }).mount();
    }

    let modalSplide = null;

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
                alert(commonInactiveMessage);
            }

            // Instantiate popovers on newly created HTML elements
            $('[data-toggle="popover"]').popover({
                animation: false,
                html: true
            });

            if (data) {
                // Refreshes some partials if the appropriate JSON response is true
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
                if (data.refreshLocations === true) {
                    loadLocations();
                }

                // Check if we have to show some User Success toast
                if (data.user_success) {
                    if (data.user_success.success) {
                        showToast('user_success', {
                            heading: data.user_success.heading,
                            description: data.user_success.description,
                        });
                    }
                }

                // Shows an informational toast on save / delete
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
                contents: PlaceholdersButtonContent,
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

    const FunctionsButton = function (context) {
        const ui = $.summernote.ui;

        // create button
        const buttonGroup = ui.buttonGroup([
            ui.button({
                className: 'dropdown-toggle',
                contents: '<i class="fa fa-cog"/> {{ trans('functions.label') }}',
                tooltip: '@lang('functions.help')',
                data: {
                    toggle: 'dropdown'
                },
                click: function () {
                    // Cursor position must be saved because it is lost when dropdown is opened.
                    context.invoke('editor.saveRange');
                }
            }),
            ui.dropdown({
                contents: FunctionsButtonContent,
                callback: function ($dropdown) {
                    $dropdown.find(".clickable").click(function () {
                        // We restore cursor position and text is inserted in correct pos.
                        context.invoke('editor.restoreRange');
                        context.invoke('editor.focus');
                        context.invoke("editor.insertText", $(this).data('value'));
                    });
                },
            })
        ]);

        return buttonGroup.render();   // return button as jquery object
    };

    @if (isset($story))
        const VariablesButton = function (context) {
            const ui = $.summernote.ui;

            // create button
            const buttonGroup = ui.buttonGroup([
                ui.button({
                    className: 'dropdown-toggle',
                    contents: '<i class="fa fa-cog"/> ' + VariablesButtonButtonContent,
                    tooltip: VariablesButtonTooltip,
                    data: {
                        toggle: 'dropdown'
                    },
                    click: function () {
                        // Cursor position must be saved because it is lost when dropdown is opened.
                        context.invoke('editor.saveRange');
                    }
                }),
                ui.dropdown({
                    contents: VariablesButtonContent,
                    callback: function ($dropdown) {
                        $dropdown.find(".clickable").click(function () {
                            // We restore cursor position and text is inserted in correct pos.
                            context.invoke('editor.restoreRange');
                            context.invoke('editor.focus');
                            context.invoke("editor.insertText", 'variable[' + $(this).data('value') + ']');
                        });
                    },
                })
            ]);

            return buttonGroup.render();   // return button as jquery object
        };
    @endif

    const PopoverButton = function (context) {
        const ui = $.summernote.ui;
        const button = ui.button({
            contents: '<span data-target="#modalDescriptions" data-toggle="modal">' + descriptionButtonText + '</span>',
            tooltip: 'Add inline descriptions'
        });

        return button.render();
    };

    const summernoteOptions = {
        lang: 'fr-FR',
        height: 300,
        maximumImageFileSize: 524288, // 512k
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            //['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']],
            ['custom', ['cleaner','placeholders', 'popovers', 'functions', 'variables']],
        ],
        //fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
        //fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto']
        buttons: {
            popovers: PopoverButton,
            placeholders: PlaceholdersButton,
            functions: FunctionsButton,
            @if (isset($story)) variables: VariablesButton, @endif
        },
        spellcheck: true,
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
                    $('#editorToggle')
                        .data('state', 'off')
                        .html(storyEditText);

                    savePage();
                }
            },
            onImageUpload: function(files, editor, welEditable) {
                let data = new FormData();
                data.append("file", files[0]);
                $.post({
                    data: data,
                    url: route('upload.image'),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        let image = $('<img>').attr('src', data.path);
                        $('.summernote').summernote("insertNode", image[0]);
                    }
                })
                    .fail(function(data) {
                        alert('Raté');
                    });
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
        spellcheck: true,
        focus: true
    };

    function loadInputSpinner() {
        $("input[type='number']").inputSpinner({
            'buttonsClass': 'btn-attribute btn-outline-secondary w-100'
        });
    }

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

        $('[data-toggle="popover"]').popover({
            animation: false,
            html: true
        });
    });

    // Convert dates to human readable strings
    function showHumanReadableDates($parent = null) {
        let $ancestor;

        if ($parent === null) {
            $ancestor = $('.moment_date');
        } else {
            $ancestor = $parent.find('.moment_date');
        }

        $ancestor.each(function (id, elt) {
            var originalDate = $(elt).html();
            var momentDate = moment(originalDate, 'YYYY-MM-DD h:mm:ss').fromNow();

            if (momentDate) {
                $(elt)
                    .html(momentDate)
                    .attr('title', originalDate);
            }
        });
    }
</script>
