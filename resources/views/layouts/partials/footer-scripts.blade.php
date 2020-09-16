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

    $(document)
        .ajaxComplete(function (event, request, settings) {
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
            if (request.responseJSON) {
                console.log(request.responseJSON);
                if (request.responseJSON.refreshInventory === true) {
                    loadInventory();
                }
                if (request.responseJSON.refreshChoices === true) {
                    loadChoices();
                }
                if (request.responseJSON.refreshSheet === true) {
                    loadSheet();
                }
                if (request.responseJSON.refreshPurse === true) {
                    loadPurse();
                }

                // Shows an informational toast
                switch (request.responseJSON.type) {
                    case 'save':
                        if (request.responseJSON.success) {
                            showToast('success', {
                                heading: saveSuccessHeading,
                                text: saveSuccessText,
                            });
                        } else {
                            showToast('error', {
                                heading: "{{ trans('notification.deletion_failed_title') }}",
                                text: "{{ trans('notification.deletion_failed_text') }}",
                                errors: data.responseJSON.errors
                            });
                        }
                        break;
                    case 'delete':
                        if (request.responseJSON.success) {
                            showToast('success', {
                                heading: deletionSuccessTitle,
                                text: deletionSuccessText,
                            });
                        } else {
                            showToast('error', {
                                heading: deletionFailedTitle,
                                text: deletionFailedText,
                                errors: data.responseJSON.errors
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
        var $this = $(this);
        if ($this.hasClass('input-invalid')) {
            $this.next().hide();
            $this.removeClass('input-invalid');
        }
    });


    var PlaceholdersButton = function (context) {
        var ui = $.summernote.ui;
        var placeholders = {
            @foreach($placeholders ?? [] as $key => $placeholder)
                '{{ $key }}': '{{ $placeholder }}',
            @endforeach
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
                    // Cursor position must be saved because it is lost when dropdown is opened.
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

    var PopoverButton = function (context) {
        var $this = $(this);
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<span data-target="#modalDescriptions" data-toggle="modal">@lang('description.descriptions_button_label')</span>',
            tooltip: 'Highlight text with red color',
            click: function() {
                $('.savePage').addClass('disabled');
            }
        });

        return button.render();
    };

    var summernoteOptions = {
        lang: 'fr-FR',
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
            ['custom', ['placeholders', 'popovers']],
        ],
        buttons: {
            placeholders: PlaceholdersButton,
            popovers: PopoverButton
        },
        spellcheck: false,
        cleaner: {
            action: 'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline: '<br>', // Summernote's default is to use '<p><br></p>'
            notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
            icon: '<i class="note-icon">[Your Button]</i>',
            keepHtml: true, // Remove all Html formats
            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>', '<img>'], // If keepHtml is true, remove all tags except these
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
            onBlur: function(e) {
                var p = e.target.parentNode.parentNode

                // Don't trigger if we click in the Summernote toolbar
                if (! (e.relatedTarget && $.contains(p, e.relatedTarget))) {
                    $('.savePage').trigger('click');
                }
            }
        }
    };

    var summernoteOptionsLight = {
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

    var loadingSpinner = '<div class="d-flex justify-content-center w-100"><div class="spinner-grow text-success" role="status"></div></div>';
</script>
