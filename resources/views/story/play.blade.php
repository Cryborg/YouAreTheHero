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
            $('.pick-item').on('click', function () {
                var $this = $(this);

                $.ajax({
                    'method': 'POST',
                    'url': '{{ route('story.ajax_action') }}',
                    'data': {
                        'actionid': $this.data('actionid'),
                        'pageid': {{ $page->id }}
                    },
                })
                    .done(function(rst) {
                        if (rst.result === true) {
                            loadInventory();
                            loadSheet();
                            loadChoices();
                        }
                        if (rst.singleuse === true) {
                            $this.remove();
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
            $('.choices-block').load('{{ route('story.choices', ['story' => $story->id, 'page' => $page->id]) }}');
        }

        @if ($page->riddle()->count())
            $(document).on('click', '#riddle_validate', function () {
                $this = $(this);

                // Toggle disabled state
                $this.prop('disabled', (i, v) => !v);

                $.post({
                    url: route('page.riddle.validate', {'page': $this.data('pageid')}),
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
                            $this.parents('.panel').addClass('panel-danger');
                        }
                    })
                    .fail(function (data) {
                        $this.parents('.panel').addClass('panel-danger');
                    })
                    .always(function () {
                        // Toggle disabled state
                        $this.prop('disabled', (i, v) => !v);

                        setTimeout(function() {
                            $this.parents('.panel').removeClass('panel-danger');
                        }, 3000);
                    });
            });
        @endif
    </script>
@endpush
