<script>
    function ajaxCreatePost(route, $this, data)
    {
        var commonData = {
            'story_id': {{ $story->id }}
        };

        $.post({
            url: route,
            data: {...data, ...commonData}
        })
            .done(function (data) {
                showToast('success', {
                    heading: '{{ trans('notification.save_success_title') }}',
                    text: "{{ trans('notification.save_success_text') }}",
                });

                // Add the newly created item to existing lists
                $('.itemSelectList').append(
                    '<option value="' + data.item.id + '">' + data.item.name + '</option>'
                );
            })
            .fail(function (data) {
                showToast('error', {
                    heading: '{{ trans('notification.save_failed_title') }}',
                    text: "{{ trans('notification.save_failed_text') }}",
                    errors: data.responseJSON.errors
                });
            })
            .always(function () {
                $this.html($this.data('original-text'));
                $this.prop('disabled', false);
            });
    }

    @for ($i = 0, $iMax = count($contexts); $i < $iMax; $i++)
    $(document).on('click', '#create_item_{{ $contexts[$i] }}', function () {
        var $this = $(this);
        var route = '{{ route('item.store') }}';
        var values = [];

        $('input[name="stat_values[]"]:visible').each(function () {
            values.push({
                'id': $(this).data('id'),
                'value': $(this).val()
            });
        });

        ajaxCreatePost(route,  $this, {
            'name': $('#item_name_{{ $contexts[$i] }}').val(),
            'default_price': $('#item_price_{{ $contexts[$i] }}').val(),
            'single_use': $('#single_use_{{ $contexts[$i] }}').is(':checked') ? 1 : 0,
            'size': $('#item_size_{{ $contexts[$i] }}').val(),
            'effects': values
        })
    });
    @endfor
</script>
