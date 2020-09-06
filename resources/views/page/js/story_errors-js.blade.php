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

    // Delete a page from the "Story errors" popin
    $(document).on('click touchstart keydown', '.deleteDeadEnd, .deleteItem, .deleteField', function () {
        const $this = $(this);
        let confirmText = '';
        let routeName = '';
        let param = '';
        let dataAttribute = '';

        if ($this.hasClass('deleteDeadEnd')) {
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

                    tryDraw();

                    showToast('success', {
                        heading: deletionSuccessTitle,
                        text: deletionSuccessText,
                    });
                }
            })
            .fail(function (data) {
                showToast('error', {
                    heading: deletionSuccessText,
                    text: deletionFailedText,
                    errors: data.responseJSON.errors
                });
            });
    });
</script>
