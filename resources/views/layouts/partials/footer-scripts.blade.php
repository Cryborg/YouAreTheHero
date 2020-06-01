<script src="https://d3js.org/d3.v5.min.js" charset="utf-8"></script>
<script src="{{ asset('js/dagre-d3.js') }}"></script>
<script src="{{ asset('js/he.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.connections.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/js.cookie.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/summernote-cleaner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/input_number.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

@if (Config::get('app.locale') !== 'en_GB')
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/moment-lang.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lang/' . Config::get('app.locale') . '/summernote.js') }}"></script>
@endif
<script type="text/javascript">
    moment.locale('fr');

    // Load emojis
    $.ajax({
        url: 'https://api.github.com/emojis',
        async: false
    }).then(function(data) {
        window.emojis = Object.keys(data);
        window.emojiUrls = data;
    });

    // Global ajax options
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Loading screen

    $(document)
        .ajaxComplete(function (event, request, settings) {
            // If the session has expired
            if (request.status === 419) {
                alert('You have been inactive for the last minutes, please refresh the page to reconnect.');
            }

            $('[data-toggle="popover"]').popover({
                animation: false,
                html: true
            });
        })
    ;

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
                data.heading = data.heading || '@lang('common.error')';
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
        hint: {
            match: /:([\-+\w]+)$/,
            search: function (keyword, callback) {
                callback($.grep(emojis, function (item) {
                    return item.indexOf(keyword)  === 0;
                }));
            },
            template: function (item) {
                var content = emojiUrls[item];
                return '<img src="' + content + '" width="20" /> :' + item + ':';
            },
            content: function (item) {
                var url = emojiUrls[item];
                if (url) {
                    return $('<img />').attr('src', url).css('width', 20)[0];
                }
                return '';
            }
        },
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
            var momentDate = moment(originalDate).fromNow();

            if (momentDate) {
                $(elt)
                    .html(momentDate)
                    .attr('title', originalDate);
            }
        });
    }

</script>
