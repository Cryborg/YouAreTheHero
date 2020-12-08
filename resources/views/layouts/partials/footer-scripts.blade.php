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

    const FunctionsButton = function (context) {
        const ui = $.summernote.ui;
        const content = "{!! includeAsJsString('story.js.partials.functions') !!}";

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
                contents: content,
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
            const content = "{!! includeAsJsString('story.js.partials.variables', ['story' => $story]) !!}";

            // create button
            const buttonGroup = ui.buttonGroup([
                ui.button({
                    className: 'dropdown-toggle',
                    contents: '<i class="fa fa-cog"/> {{ trans('variables.label') }}',
                    tooltip: '{{ trans('variables.help') }}',
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
                            context.invoke("editor.insertText", 'variable[' + $(this).data('value') + ']');
                        });
                    },
                })
            ]);

            return buttonGroup.render();   // return button as jquery object
        };
    @endif

    const PopoverButton = function (context) {
        var $this = $(this);
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<span data-target="#modalDescriptions" data-toggle="modal">@lang('description.descriptions_button_label')</span>',
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

    const loadingSpinner = "{!! includeAsJsString('partials.overlay_spinner') !!}";
</script>
