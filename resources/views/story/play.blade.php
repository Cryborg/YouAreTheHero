@extends('layouts.' . $layout)

@section('title', $title)

@section('map')
    @foreach ($visitedPlaces as $place)
        <a href="{{ route('story.play', ['story' => $story->id, 'page' => $place->page_id]) }}">{{ $place->page_title }}</a><br>
    @endforeach
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#add_PageReport', function () {
                var $this = $(this);
                var type = $('#modalPageReport #report_error_type option:selected').val();
                var comment = $('#modalPageReport #report_comment').val();

                $.post({
                    url: route('report.store', {page: {{ $page->id }} }),
                    data: {
                        'error_type': type,
                        'comment': comment
                    }
                })
                    .done(function (data) {
                        if (data.success) {
                            showToast('success', {
                                heading: "{{ trans('notification.save_success_title') }}",
                                text: "{{ trans('notification.save_success_text') }}",
                            });
                        } else {
                            showToast('error', {
                                heading: '{{ trans('notification.save_failed_title') }}',
                                text: "{{ trans('notification.save_failed_text') }}",
                            });
                        }
                    })
                    .fail(function (data) {
                        showToast('error', {
                            heading: '{{ trans('notification.save_failed_title') }}',
                            text: "{{ trans('notification.save_failed_text') }}",
                        });
                    });
            });

            // Ajax links
            $(document).on('click', 'a', function () {
                var $this = $(this);
                var href = $this.data('href');

                if (href !== undefined) {
                    $.get({
                        url: href
                    })
                    .done(function (res) {
                        $('#page_content').html(res);
                    })
                }
            });

            // When the player clicks on an item
            $('.pick-item button').on('click', function () {
                var $this = $(this);

                $.get({
                    'url': route('item.take', {'page': {{ $page->id }}, 'item': $this.data('itemid')}),
                })
                    .done(function(rst) {
                        if (rst.result == true) {
                            loadInventory();
                            loadSheet();
                            loadChoices();

                            if (rst.singleuse === true) {
                                $this.closest('.pick-item').remove();
                            }
                        } else {
                            if (rst.message) {
                                showToast('error', {
                                    text: rst.message
                                });
                            }
                        }
                    });
            });

        });

        $(function() {
            loadInventory();
            loadSheet();
            loadChoices();
        });

        function loadInventory() {
            $('.inventory-block').load('{{ route('story.inventory', ['story' => $story->id]) }}');
        }

        function loadSheet() {
            $('.sheet-block').load('{{ route('story.sheet', ['story' => $story->id]) }}');
        }

        function loadChoices() {
            $('.choices-block').load('{{ route('page.choices', ['page' => $page->id]) }}');
        }

        @if ($page->riddle()->count())
            $(document).on('click', '#riddle_validate', function () {
                $this = $(this);

                // Toggle disabled state
                $this.prop('disabled', (i, v) => !v);

                $.post({
                    url: route('page.riddle.validate', {'page': {{ $page->id }}}),
                    data: {
                        'answer': $('#riddle_answer').val()
                    }
                })
                    .done(function (data) {
                        if (data.success) {
                            if (data.itemResponse) {
                                $('.riddle-block').html(data.itemResponse);
                            }

                            if (data.pageResponse) {
                                $('.btn-toolbar').append(data.pageResponse);
                            }

                            if (data.refreshInventory !== false) {
                                loadInventory();
                                loadChoices();
                            }
                        } else {
                            $this.closest('.card').addClass('border-danger');
                        }
                    })
                    .fail(function (data) {
                        $this.closest('.card').addClass('border-danger');
                    })
                    .always(function () {
                        // Toggle disabled state
                        $this.prop('disabled', (i, v) => !v);

                        setTimeout(function() {
                            $this.closest('.card').removeClass('border-danger');
                        }, 3000);
                    });
            });
        @endif
    </script>
@endpush
