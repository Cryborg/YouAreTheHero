<script type="text/javascript">
    function newPage($this, route)
    {
        var newNumber = $('a.nav-item.nav-link').length;
        $('a.nav-item.nav-link, div.tab-pane').removeClass('active');

        $('#addNewPage').before(
            '<a class="nav-item nav-link active" href="#p' + newNumber + '" data-toggle="tab">' +
            '<span class="choice_title_' + newNumber + '">' +
            '<input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-' + newNumber + '">' +
            '<div class="alert alert-error hidden"></div>' +
            '</span></span>' +
            '</a>');
        $.ajax({
            'url': route,
            'data': {'internalId': newNumber}
        })
            .done(function (data) {
                $('#choicesForm').append('<div class="tab-pane active" id="p' + newNumber + '">' + data + '</div>');
            })
            .always(function () {
                $this.prop('disabled', false);
            });
    }

    $(document).ready(function () {
        // help-block state check from cookie
        var openToggle = Cookies.get("hero.help-block.show") || false;

        if ( openToggle === 'true') {
            $("p.help-block").show();
        } else {
            $("p.help-block").hide();
        }

        $('.toggle-help').on('click', function() {
            var $pBlocks = $('p.help-block');
            var done = false;

            // Toggle display
            $pBlocks.slideToggle(function () {
                if (!done) {
                    // Update or create the cookie to save state
                    Cookies.set('hero.help-block.show', $pBlocks.eq(0).is(':visible'), {expires: 365});
                    done = true;
                }
            });
        });

        // Create a new tab
        $('#addNewPage').on('click', function(event) {
            event.preventDefault();

            var $this = $(this);
            $this.prop('disabled', true);

            newPage($this, route('page.create', {{ $page->story_id }}));
        });

        $(document).on('click', '.submit-btn', function (e) {
            let $this = $(this).parent('form');
            e.preventDefault();

            // internalId is 0 if the form being submitted is the main page.
            // Otherwise it is > 0
            var internalId = $this.data('internalid');
            var pageLinkTitle = $('#linktext-' + internalId).val();

            var data = $this.serialize();
            if (internalId > 0) data += '&linktitle=' + encodeURIComponent(pageLinkTitle);
            data += '&page_from=' + $('#page_from').val();

            $.ajax({
                method: $this.attr('method'),
                url: $this.attr('action'),
                data: data
            })
                .done(function (data) {
                })
                .fail(function (data) {
                    if(data.status == 422) {
                        $.each(data.responseJSON.errors, function (i, error) {
                            $this
                                .find('[name="' + i + '"]')
                                .addClass('input-invalid')
                                .next()
                                .append(error[0])
                                .removeClass('hidden');
                        });
                    }
                });
        });
    });

    $('.nav-item.nav-link select').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        if ($this.val() == 0) return false;

        $this.prop('disabled', true);

        newPage($this, route('page.create', [{{ $page->story_id }}, $this.val()]));

        $("#childrenSelect option:selected").remove();
    });
</script>
