@extends('layouts.' . $layout)

@section('title', $title)

@section('riddle')
    @if ($page->riddle()->count() > 0)
        @include('story.partials.riddle', ['data' => $page->riddle])
    @endif
@endsection

@section('choices')
    @include('story.partials.choices', ['page' => $page, 'story' => $story])
@endsection

@section('actions')
    @foreach ($actions as $action)
        @switch($action['verb'])
            @case ('buy')
            @case ('earn')
            @case ('sell')
            @case ('give')
                <div class="pick-item" data-verb="{{ $action['verb'] }}" data-item="{{ $action['item']->id }}" data-price="{{ $action['price'] > 0 ?: $action['item']->default_price  }}" data-singleuse="{{ $action['item']->single_use }}">
                    @include('story.partials.money', [
                        'value' => $action['price'] > 0 ?: $action['item']->default_price,
                        'operator' => in_array($action['verb'], ['sell','give']) ? 'add' : 'sub',
                        'name' => $action['item']['name']
                    ])
{{--                    @if ($action['item']->effects)--}}
{{--                        @foreach ($action['item']->effects as $effect => $value)--}}
{{--                            @include('story.partials.effects', [--}}
{{--                                'name' => $effect,--}}
{{--                                'value' => $value['quantity'],--}}
{{--                                'operator' => $value['operator'] === '+' ? 'add' : 'sub'--}}
{{--                            ])--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
                </div>
                @break
        @endswitch
    @endforeach
@endsection

@section('map')
    @foreach ($visitedPlaces as $key => $place)
        <a href="{{ route('story.play', ['story' => $story->id, 'page' => $place->page_uuid]) }}">{{ $place->page_title }}</a><br>
    @endforeach
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(function() {
            loadInventory();
            loadSheet();
            loadChoices();
        });

        function loadInventory() {
            $('.inventory-block').load('{{ route('story.inventory', ['story' => $story->id]) }}', function () {
                $('.pick-item').each(function () {
                    var $this = $(this);

                    // Reset the links
                    $this.unbind('click');
                    $this.removeClass('has-money');

                    // If the character has enough money
                    // OR if the action will credit money
                    if ($('#character_money').html() >= $(this).data('price') || $.inArray($this.data('verb'), ['earn']) > -1) {
                        $this.addClass('has-money');

                        $this.on('click', function()
                        {
                            if ($this.data('singleuse')) {
                                $this.remove();
                            }

                            $.ajax({
                                'method': 'POST',
                                'url': '{{ route('story.ajax_action') }}',
                                'data': {'json': JSON.stringify($this.data())},
                            })
                            .done(function(rst) {
                                if (rst.result === true) {
                                    loadInventory();
                                    loadSheet();
                                    loadChoices();
                                }
                            });
                        });
                    }
                });
            });
        }

        function loadSheet() {
            $('.sheet-block').load('{{ route('story.sheet', ['story' => $story->id]) }}');
        }

        function loadChoices() {
            $('.choices-block').load('{{ route('story.choices', ['story' => $story->id, 'page' => $page->uuid]) }}');
        }

        @if ($page->riddle()->count())
            $('#riddle_validate').on('click', function () {
                $this = $(this);

                // Toggle disabled state
                $this.prop('disabled', (i, v) => !v);

                $.post({
                    url: route('page.riddle.validate', {'page': '{{ $page->uuid }}'}),
                    data: {
                        'answer': $('#riddle_answer').val()
                    }
                })
                    .done(function (data) {
                        if (data.success) {
                            $('#riddle_block').html(data.response);

                            if (data.refreshInventory !== false) {
                                loadInventory();
                                loadChoices();
                            }
                        } else {
                            var oldBorder = $('#riddle_answer').css('border');
                            $('#riddle_answer').toggleClass('input-invalid');

                            setTimeout(function() {
                                $('#riddle_answer').toggleClass('input-invalid');
                            }, 3000);
                        }
                    })
                    .fail(function (data) {
                    })
                    .always(function () {
                        // Toggle disabled state
                        $this.prop('disabled', (i, v) => !v);
                    });
            });
        @endif
    </script>
@endpush
