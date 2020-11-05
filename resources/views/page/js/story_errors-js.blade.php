<script>
    $(document).on('show.bs.modal', '#modalStoryErrors', function (event)
    {
        $.get({
            url: route('story.errors', {story: {{ $data['page']->story->id }}})
        })
            .done(function (html) {
                $('#modalStoryErrors .modal-body').html(html);
            });
    });

    $(document).on("hidden.bs.modal", '#modalStoryErrors', function () {
        $.get({
            url: route('story.has_errors', {story: {{ $data['page']->story->id }}})
        })
            .done(function (res) {
                if (res.has_errors) {
                    $('.showStoryErrors').show();
                } else {
                    $('.showStoryErrors').hide();
                }
            });
    });

    // Delete a page from the "Story errors" popin
    $(document).on('click touchstart keydown', '.deleteOrphan, .deleteItem, .deleteField', function () {
        const $this = $(this);
        let confirmText = '';
        let routeName = '';
        let param = '';
        let dataAttribute = '';

        if ($this.hasClass('deleteOrphan')) {
            confirmText = confirmDeletePageText;
            routeName = 'page.delete';
            param = 'page';
            dataAttribute = 'pageid';
        }

        if ($this.hasClass('deleteItem')) {
            confirmText = confirmDeleteItemText;
            routeName = 'item.delete';
            param = 'item';
            dataAttribute = 'itemid';
        }

        if ($this.hasClass('deleteField')) {
            confirmText = confirmDeleteFieldText;
            routeName = 'field.delete';
            param = 'field';
            dataAttribute = 'fieldid';
        }

        if (!confirm(confirmText)) return false;

        $.ajax({
            url: route(routeName, {[param]: $this.data(dataAttribute)}),
            method: 'DELETE'
        })
            .done(function (result) {
                if (result.success) {
                    $('#modalStoryErrors').trigger('show.bs.modal');

                    tryDraw(result.graph);
                }
            });
    });
</script>
